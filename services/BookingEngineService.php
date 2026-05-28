<?php

require_once __DIR__ . '/../models/Appointment.php';

class BookingEngineService
{
    private $appointmentModel;

    private $openingHour = '08:00';
    private $lastSlot = '18:30';
    private $consultationDuration = 60;
    private $videoBuffer = 5;
    private $homeBuffer = 10;

    public function __construct()
    {
        $this->appointmentModel = new Appointment();
    }

    public function getAvailableSlots($date, $consultationType)
    {
        $dayOfWeek = date('N', strtotime($date));

        // samedi fermé
        if ($dayOfWeek == 6) {
            return [];
        }

        $appointments = $this->appointmentModel->getAppointmentsByDate($date);
        $lastAppointment = $this->appointmentModel->getLastAppointmentByDate($date);
        $blockedSlots = $this->appointmentModel->getBlockedSlotsByDate($date);

        $slots = $this->generateFixedSlots();

        foreach ($appointments as $appointment) {

            $takenTime = date('H:i', strtotime($appointment['appointment_start']));

            $slots = array_filter($slots, function ($slot) use ($takenTime) {
                return $slot !== $takenTime;
            });
        }

        if ($lastAppointment) {

            $specialSlot = date('H:i', strtotime($lastAppointment['appointment_end']));

            if ($lastAppointment['consultation_type'] === 'consultation_domicile') {

                $specialTimestamp = strtotime($specialSlot);
                $specialTimestamp += ($lastAppointment['travel_minutes'] * 60);
                $specialTimestamp += ($this->homeBuffer * 60);

                $specialSlot = date('H:i', $specialTimestamp);
            }

            if ($lastAppointment['consultation_type'] === 'consultation_video') {

                $specialTimestamp = strtotime($specialSlot);
                $specialTimestamp += ($this->videoBuffer * 60);

                $specialSlot = date('H:i', $specialTimestamp);
            }

            // suppression des créneaux avant le specialSlot
            $slots = array_filter($slots, function ($slot) use ($specialSlot) {
                return strtotime($slot) >= strtotime($specialSlot);
            });

            // ajout du specialSlot si valide
            if (
                strtotime($specialSlot) <= strtotime($this->lastSlot)
                &&
                (
                    $date !== date('Y-m-d')
                    || strtotime($date . ' ' . $specialSlot) - time() >= 3600
                )
            ) {

                if (!in_array($specialSlot, $slots)) {
                    $slots[] = $specialSlot;
                }
            }
        }

        foreach ($blockedSlots as $blockedSlot) {

            $blockedTime = date('H:i', strtotime($blockedSlot['blocked_start']));

            $slots = array_filter($slots, function ($slot) use ($blockedTime) {
                return $slot !== $blockedTime;
            });
        }

        // suppression créneaux trop proches
        if ($date === date('Y-m-d')) {

            $now = time();

            $slots = array_filter($slots, function ($slot) use ($date, $now) {

                $slotTimestamp = strtotime($date . ' ' . $slot);

                return ($slotTimestamp - $now) >= 3600;
            });
        }

        sort($slots);

        return array_values($slots);
    }

    private function generateFixedSlots()
    {
        $slots = [];

        $current = strtotime($this->openingHour);
        $end = strtotime($this->lastSlot);

        while ($current <= $end) {

            $slots[] = date('H:i', $current);

            $current = strtotime('+1 hour', $current);
        }

        return $slots;
    }
}
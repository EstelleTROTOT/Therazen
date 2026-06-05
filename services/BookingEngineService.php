<?php

require_once __DIR__ . '/../models/Appointment.php';

class BookingEngineService
{
    private Appointment $appointmentModel;

    private string $openingHour = '08:00';
    private string $closingHour = '20:00';

    private int $visioDuration = 60;
    private int $visioBuffer = 7;

    private int $homeDuration = 60;
    private int $homeBuffer = 20;

    public function __construct()
    {
        $this->appointmentModel = new Appointment();
    }

    public function getAvailableSlots(string $date, string $consultationType): array
    {
        $dayOfWeek = date('N', strtotime($date));

        // Samedi fermé
        if ($dayOfWeek == 6) {
            return [];
        }

        $appointments = $this->appointmentModel->getAppointmentsByDate($date);

        $slots = [];

        $current = strtotime($date . ' ' . $this->openingHour);
        $end = strtotime($date . ' ' . $this->closingHour);

        while ($current < $end) {

            if ($this->isSlotAvailable(
                $current,
                $appointments,
                $consultationType
            )) {
                $slots[] = date('H:i', $current);
            }

            $current = strtotime('+1 hour', $current);
        }

        return $slots;
    }

    private function isSlotAvailable(
    int $slotTimestamp,
    array $appointments,
    string $consultationType
): bool {

    $duration = $this->getConsultationDuration($consultationType);

    $slotStart = $slotTimestamp;
    $slotEnd = $slotStart + ($duration * 60);

    foreach ($appointments as $appointment) {

        $appointmentStart = strtotime(
            $appointment['appointment_start']
        );

        $appointmentEnd = strtotime(
            $appointment['appointment_end']
        );

        if (
            $slotStart < $appointmentEnd &&
            $slotEnd > $appointmentStart
        ) {
            return false;
        }
    }

    return true;
}

    private function getConsultationDuration(
        string $consultationType
    ): int {

        if ($consultationType === 'domicile') {
            return $this->homeDuration + $this->homeBuffer;
        }

        return $this->visioDuration + $this->visioBuffer;
    }
}
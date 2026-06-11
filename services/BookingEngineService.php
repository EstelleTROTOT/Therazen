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

    // Interdiction de réserver moins d'1 heure à l'avance
    $today = date('Y-m-d');

    if (date('Y-m-d', $slotTimestamp) === $today) {
        

        $minimumAllowedTime = strtotime('+1 hour');

        if ($slotTimestamp <= $minimumAllowedTime) {
            return false;
        }
    }

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

        if ($consultationType === 'consultation_domicile') {
            return $this->homeDuration + $this->homeBuffer;
        }

        return $this->visioDuration + $this->visioBuffer;
    }
}
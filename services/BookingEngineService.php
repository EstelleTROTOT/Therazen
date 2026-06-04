<?php

require_once __DIR__ . '/../models/Appointment.php';

class BookingEngineService
{
    private $appointmentModel;

    private $openingHour = '08:00';
    private $lastSlot = '18:00';

    public function __construct()
    {
        $this->appointmentModel = new Appointment();
    }

    public function getAvailableSlots($date, $consultationType)
    {
        $dayOfWeek = date('N', strtotime($date));

        // Samedi fermé
        if ($dayOfWeek == 6) {
            return [];
        }

        $slots = [];

        $current = strtotime($date . ' ' . $this->openingHour);
        $end = strtotime($date . ' ' . $this->lastSlot);

        while ($current <= $end) {

            $slots[] = date('H:i', $current);

            $current = strtotime('+1 hour', $current);
        }

     
// Réservation impossible moins d'1h avant

        return array_values($slots);
    }
}
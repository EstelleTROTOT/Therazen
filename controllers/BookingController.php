<?php

require_once __DIR__ . '/../services/BookingEngineService.php';

class BookingController
{
    public function test()
    {
        $bookingEngine = new BookingEngineService();

        $slots = $bookingEngine->getAvailableSlots(
            date('Y-m-d'),
            'consultation_video'
        );

        echo '<pre>';
        print_r($slots);
        echo '</pre>';
    }

    public function index()
    {
        $bookingEngine = new BookingEngineService();

        // Date sélectionnée
        $selectedDate = $_GET['date'] ?? date('Y-m-d');

        // Type sélectionné
        $selectedType = $_GET['type'] ?? 'consultation_video';

        // Créneaux disponibles
        $slots = $bookingEngine->getAvailableSlots(
            $selectedDate,
            $selectedType
        );

        // 35 jours affichés dans l'agenda
        $dates = [];

        for ($i = 0; $i < 35; $i++) {
            $dates[] = date('Y-m-d', strtotime("+$i day"));
        }

        require_once __DIR__ . '/../views/booking.php';
    }

    public function informations()
    {
        require_once __DIR__ . '/../views/booking-informations.php';
    }
}
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

        // Calendrier mensuel

$currentMonth = (int)($_GET['month'] ?? date('n', strtotime($selectedDate)));
$currentYear = (int)($_GET['year'] ?? date('Y', strtotime($selectedDate)));

$firstDayOfMonth = strtotime("$currentYear-$currentMonth-01");

$daysInMonth = date('t', $firstDayOfMonth);
$firstWeekDay = date('N', $firstDayOfMonth);

$dates = [];

// Cases vides avant le 1er du mois

for ($i = 1; $i < $firstWeekDay; $i++) {
    $dates[] = null;
}

// Jours du mois

for ($day = 1; $day <= $daysInMonth; $day++) {
    $dates[] = sprintf(
        '%04d-%02d-%02d',
        $currentYear,
        $currentMonth,
        $day
    );
}

        require_once __DIR__ . '/../views/booking.php';
    }

    public function informations()
    {
        require_once __DIR__ . '/../views/booking-informations.php';
    }
}
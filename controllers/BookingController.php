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
$selectedType = $_GET['type'] ?? '';

// Créneaux disponibles
$slots = [];

if (!empty($selectedType)) {

    $slots = $bookingEngine->getAvailableSlots(
        $selectedDate,
        $selectedType
    );

}

        // Calendrier mensuel


$currentMonth = (int)($_GET['month'] ?? date('n', strtotime($selectedDate)));
$currentYear = (int)($_GET['year'] ?? date('Y', strtotime($selectedDate)));

$firstDayOfMonth = strtotime("$currentYear-$currentMonth-01");

$daysInMonth = date('t', $firstDayOfMonth);

$dates = [];

// Aujourd'hui est autorisé
$minBookingDate = date('Y-m-d');

// Recherche du premier jour ouvré affiché
$firstDisplayedWeekDay = null;

for ($day = 1; $day <= $daysInMonth; $day++) {

    $testDate = sprintf(
        '%04d-%02d-%02d',
        $currentYear,
        $currentMonth,
        $day
    );

    if ($testDate < $minBookingDate) {
        continue;
    }

    $weekDay = date('N', strtotime($testDate));

    if ($weekDay <= 5) {
        $firstDisplayedWeekDay = $weekDay;
        break;
    }
}

$emptyDays = ($firstDisplayedWeekDay ?? 1) - 1;

for ($i = 0; $i < $emptyDays; $i++) {
    $dates[] = null;
}

for ($day = 1; $day <= $daysInMonth; $day++) {

    $date = sprintf(
        '%04d-%02d-%02d',
        $currentYear,
        $currentMonth,
        $day
    );

    // Cache uniquement les jours passés
    if ($date < $minBookingDate) {
        continue;
    }

    $weekDay = date('N', strtotime($date));

    // Samedi et dimanche fermés
    if ($weekDay >= 6) {
        continue;
    }

    $dates[] = $date;
}

require_once __DIR__ . '/../views/booking.php';
}

public function informations()
{
    $selectedDate = $_GET['date'] ?? '';
    $selectedType = $_GET['type'] ?? '';
    $slot = $_GET['slot'] ?? '';

    require_once __DIR__ . '/../views/booking-informations.php';
}

}
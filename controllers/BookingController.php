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

// Conversion vers une semaine de 5 jours (Lun → Ven)

$emptyDays = min($firstWeekDay - 1, 4);

for ($i = 0; $i < $emptyDays; $i++) {
    $dates[] = null;
}

$minBookingDate = date('Y-m-d', strtotime('+1 day'));

for ($day = 1; $day <= $daysInMonth; $day++) {

    $date = sprintf(
        '%04d-%02d-%02d',
        $currentYear,
        $currentMonth,
        $day
    );

    if ($date < $minBookingDate) {
        
        continue;
    }

    $weekDay = date('N', strtotime($date));
// 6 = samedi
// 7 = dimanche
if ($weekDay >= 6) {
    continue;
}

$dates[] = $date;
}
        require_once __DIR__ . '/../views/booking.php';
    }

    public function informations()
    {
        require_once __DIR__ . '/../views/booking-informations.php';
    }
}
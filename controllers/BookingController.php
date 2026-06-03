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

        echo "<pre>";
        print_r($slots);
        echo "</pre>";
    }

    public function index()
{
    $bookingEngine = new BookingEngineService();

    $slots = $bookingEngine->getAvailableSlots(
        date('Y-m-d'),
        'consultation_video'
    );

    require_once __DIR__ . '/../views/booking.php';
}
    public function informations()
    {
        require_once __DIR__ . '/../views/booking-informations.php';
    }
}
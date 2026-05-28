<?php

require_once __DIR__ . '/../services/BookingEngineService.php';

class BookingController
{
    public function test()
    {
        $bookingEngine = new BookingEngineService();

        $slots = $bookingEngine->getAvailableSlots(date('Y-m-d'), 'consultation_video');

        echo "<pre>";
        print_r($slots);
        echo "</pre>";
    }
    public function index()
{
    require_once __DIR__ . '/../views/booking/index.php';
}
}
<?php

require_once __DIR__ . '/../services/BookingEngineService.php';

class BookingController
{
    public function test()
    {
        $bookingEngine = new BookingEngineService();

        $slots = $bookingEngine->getAvailableSlots(date('Y-m-d'));

        echo "<pre>";
        print_r($slots);
        echo "</pre>";
    }
}
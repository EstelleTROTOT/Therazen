<?php

require_once __DIR__ . '/../models/Appointment.php';

class BookingEngineService
{
    private $appointmentModel;

    public function __construct()
    {
        $this->appointmentModel = new Appointment();
    }

  foreach ($appointments as $appointment) {
    $takenTime = date('H:i', strtotime($appointment['appointment_start']));

    $slots = array_filter($slots, function ($slot) use ($takenTime) {
        return $slot !== $takenTime;
    });
}
foreach ($blockedSlots as $blockedSlot) {
    $blockedTime = date('H:i', strtotime($blockedSlot['blocked_start']));

    $slots = array_filter($slots, function ($slot) use ($blockedTime) {
        return $slot !== $blockedTime;
    });
}
if ($date === date('Y-m-d')) {
    $now = time();

    $slots = array_filter($slots, function ($slot) use ($date, $now) {
        $slotTimestamp = strtotime($date . ' ' . $slot);

        return ($slotTimestamp - $now) >= 3600;
    });
}

return array_values($slots);
}
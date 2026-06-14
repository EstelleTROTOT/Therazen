<?php

require_once __DIR__ . '/../services/BookingEngineService.php';
require_once __DIR__ . '/../services/MailService.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Appointment.php';

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
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['booking_submit'])) {

        $_SESSION['booking'] = [
            'date' => $_POST['appointment_date'],
            'type' => $_POST['appointment_type'],
            'slot' => $_POST['appointment_slot'],

            'lastname' => trim($_POST['lastname']),
            'firstname' => trim($_POST['firstname']),
            'birthdate' => $_POST['birthdate'],
            'phone' => trim($_POST['phone']),
            'email' => trim($_POST['email']),
            'reason' => trim($_POST['reason']),
            'password' => $_POST['password'] ?? ''
        ];

        require_once __DIR__ . '/../views/booking-confirmation.php';
        return;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm_booking'])) {

        $booking = $_SESSION['booking'];

        $userModel = new User();

        $user = $userModel->findByEmail($booking['email']);

        if (!$user) {

            $password = !empty($booking['password'])
                ? $booking['password']
                : bin2hex(random_bytes(8));

            $userModel->create(
                $booking['firstname'],
                $booking['lastname'],
                $booking['email'],
                $password,
                $booking['phone']
            );

            $user = $userModel->findByEmail($booking['email']);
        }

        $patientId = $user['id'];

        $appointmentModel = new Appointment();

        $appointmentStart = $booking['date'] . ' ' . $booking['slot'] . ':00';

        $duration = $booking['type'] === 'consultation_domicile'
            ? 80
            : 67;

        $appointmentEnd = date(
            'Y-m-d H:i:s',
            strtotime($appointmentStart . " +{$duration} minutes")
        );

        $appointment = $appointmentModel->createAppointment(
    $patientId,
    $booking['type'],
    $booking['reason'],
    null,
    null,
    null,
    $appointmentStart,
    $appointmentEnd
);

if (
    $booking['type'] === 'consultation_video'
    && !empty($appointment['meeting_room_name'])
) {
    $booking['meeting_link'] =
        'https://meet.jit.si/' . $appointment['meeting_room_name'];
}

$mailService = new MailService();
$mailService->sendBookingConfirmation($booking);

$_SESSION['successBooking'] = $booking;

if (!empty($booking['meeting_link'])) {
    $_SESSION['successBooking']['meeting_link']
        = $booking['meeting_link'];
}

unset($_SESSION['booking']);

header('Location: ?page=booking-success');
exit;
    }

    $selectedDate = $_GET['date'] ?? '';
    $selectedType = $_GET['type'] ?? '';
    $slot = $_GET['slot'] ?? '';

    require_once __DIR__ . '/../views/booking-informations.php';
}
}
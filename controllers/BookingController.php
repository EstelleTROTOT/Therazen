<?php

require_once __DIR__ . '/../services/BookingEngineService.php';
require_once __DIR__ . '/../services/MailService.php';
require_once __DIR__ . '/../services/RouteService.php';
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

        
    }

public function index()
{
    $bookingEngine = new BookingEngineService();

    $selectedDate = $_GET['date'] ?? date('Y-m-d');
    $selectedType = $_GET['type'] ?? '';
    $address = trim($_GET['address'] ?? '');

    $slots = [];

$isAddressValid = false;

$distanceKm = null;
$travelMinutes = null;
$travelFee = 0;
$totalPrice = 42;

    if (
        $selectedType === 'consultation_domicile'
        && !empty($address)
    ) {

        $routeService = new RouteService();

        $therapistCoordinates = $routeService->geocodeAddress(
            '100 Rue du Buyat, 01800 Saint-Jean-de-Niost'
        );

        $patientCoordinates = $routeService->geocodeAddress(
            $address
        );
        
        
        $isAddressValid = $patientCoordinates !== null;
        if (!$patientCoordinates) {

    $distanceKm = null;
    $travelMinutes = null;
    $travelFee = 0;

}

        if (
    $therapistCoordinates
    && $patientCoordinates
    && !empty($therapistCoordinates['latitude'])
    && !empty($patientCoordinates['latitude'])
)
{

            $route = $routeService->calculateDistance(
                $therapistCoordinates['latitude'],
                $therapistCoordinates['longitude'],
                $patientCoordinates['latitude'],
                $patientCoordinates['longitude']
            );

           if ($route) {
    $distanceKm = $route['distance_km'];
    $travelMinutes = $route['duration_minutes'];

    if ($distanceKm < 10) {

    $travelFee = 5;

} elseif ($distanceKm < 15) {

    $travelFee = 10;

} elseif ($distanceKm <= 20) {

    $travelFee = 15;

}

    $totalPrice = 42 + $travelFee;
}
        }
    }

   if (
    !empty($selectedType)
    && (
        $selectedType === 'consultation_video'
        || $isAddressValid
    )
) {

    $slots = $bookingEngine->getAvailableSlots(
        $selectedDate,
        $selectedType
    );
}

    $currentMonth = (int)($_GET['month'] ?? date('n', strtotime($selectedDate)));
    $currentYear = (int)($_GET['year'] ?? date('Y', strtotime($selectedDate)));

    $firstDayOfMonth = strtotime("$currentYear-$currentMonth-01");
    $daysInMonth = date('t', $firstDayOfMonth);

    $dates = [];

    $minBookingDate = date('Y-m-d');

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

        if ($date < $minBookingDate) {
            continue;
        }

        $weekDay = date('N', strtotime($date));

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
'address' => $_POST['appointment_address'] ?? '',

'travel_fee' => (int) ($_POST['travel_fee'] ?? 0),
'total_price' => (int) ($_POST['total_price'] ?? 42),

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



    $selectedDate = $_GET['date'] ?? '';
    $selectedType = $_GET['type'] ?? '';
    $slot = $_GET['slot'] ?? '';

    require_once __DIR__ . '/../views/booking-informations.php';
    }

public function stripeCheckout()
{
    require_once __DIR__ . '/../services/StripeService.php';

    if (empty($_SESSION['booking'])) {
        header('Location: ?page=booking');
        exit;
    }

    $stripeService = new StripeService();

    $checkoutUrl = $stripeService->createCheckoutSession(
        $_SESSION['booking']
    );

    header('Location: ' . $checkoutUrl);
    exit;
}

public function stripeSuccess()
{
    require_once __DIR__ . '/../services/StripeService.php';

$stripeService = new StripeService();

$session = $stripeService->getSession(
    $_GET['session_id']
);

if ($session->payment_status !== 'paid') {

    header('Location: ?page=booking');
    exit;
}


if (empty($_SESSION['booking'])) {
    header('Location: ?page=booking-success');
    exit;
}
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
    $booking['address'] ?? null,
    preg_match('/\b\d{5}\b/', $booking['address'], $cp) ? $cp[0] : null,
    preg_match('/\b\d{5}\b\s+(.+)$/', $booking['address'], $ville) ? trim($ville[1]) : null,
    $appointmentStart,
    $appointmentEnd,
    $session->id
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
}}
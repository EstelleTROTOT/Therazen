<?php

class Router
{
    public function dispatch()
    {
        $page = $_GET['page'] ?? 'home';

        switch ($page) {

            case 'home':
                require_once __DIR__ . '/../controllers/HomeController.php';
                $controller = new HomeController();
                $controller->index();
                break;

            case 'login':
                require_once __DIR__ . '/../controllers/AuthController.php';
                $controller = new AuthController();
                $controller->login();
                break;

            case 'logout':
                require_once __DIR__ . '/../controllers/AuthController.php';
                $controller = new AuthController();
                $controller->logout();
                break;

            case 'register':
                require_once __DIR__ . '/../controllers/AuthController.php';
                $controller = new AuthController();
                $controller->register();
                break;

            case 'dashboard':
                require_once __DIR__ . '/../controllers/DashboardController.php';
                $controller = new DashboardController();
                $controller->index();
                break;

                        case 'dashboard-rendezvous':
                require_once __DIR__ . '/../controllers/DashboardController.php';
                $controller = new DashboardController();
                $controller->rendezvous();
                break;

            case 'dashboard-profile':
                require_once __DIR__ . '/../controllers/DashboardController.php';
                $controller = new DashboardController();
                $controller->profile();
                break;

            

            case 'dashboard-payments':
                require_once __DIR__ . '/../controllers/DashboardController.php';
                $controller = new DashboardController();
                $controller->payments();
                break;

            case 'booking-test':
                require_once __DIR__ . '/../controllers/BookingController.php';
                $controller = new BookingController();
                $controller->test();
                break;

            case 'booking':
                require_once __DIR__ . '/../controllers/BookingController.php';
                $controller = new BookingController();
                $controller->index();
                break;

                case 'booking-informations':
    require_once __DIR__ . '/../controllers/BookingController.php';
    $controller = new BookingController();
    $controller->informations();
    break;

    case 'booking-success':
    require_once __DIR__ . '/../views/booking-success.php';
    break;


    case 'stripe-checkout':
    require_once __DIR__ . '/../controllers/BookingController.php';
    $controller = new BookingController();
    $controller->stripeCheckout();
    break;

case 'stripe-success':
    require_once __DIR__ . '/../controllers/BookingController.php';
    $controller = new BookingController();
    $controller->stripeSuccess();
    break;
            default:
                echo "Page introuvable";
                break;
        }
    }
}
<?php

require_once __DIR__ . '/../models/Appointment.php';
require_once __DIR__ . '/../models/User.php';

class DashboardController
{
   public function index()
{
    if (!isset($_SESSION['user'])) {
        header('Location: ?page=login');
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $userModel = new User();

        $userModel->updateProfile(

            $_SESSION['user']['id'],

            $_POST['first_name'],
            $_POST['last_name'],
            $_POST['email'],
            $_POST['phone']

        );

        $_SESSION['user']['first_name'] = $_POST['first_name'];
        $_SESSION['user']['last_name']  = $_POST['last_name'];
        $_SESSION['user']['email']      = $_POST['email'];
        $_SESSION['user']['phone']      = $_POST['phone'];

    }

    $appointmentModel = new Appointment();

    $nextAppointment = $appointmentModel->getNextAppointmentByPatientId(
        $_SESSION['user']['id']
    );

    require_once __DIR__ . '/../views/dashboard-patient.php';
}

       public function profile()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ?page=login');
            exit;
        }

        require_once __DIR__ . '/../views/dashboard-profile.php';
    }

    public function rendezvous()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ?page=login');
            exit;
        }

        $appointmentModel = new Appointment();

        $appointments = $appointmentModel->getAppointmentsByPatientId(
            $_SESSION['user']['id']
        );

        require_once __DIR__ . '/../views/dashboard-rendezvous.php';
    }

    public function payments()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ?page=login');
            exit;
        }

        require_once __DIR__ . '/../views/dashboard-payments.php';
    }
}
<?php

require_once __DIR__ . '/../models/User.php';

class AuthController
{
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $userModel = new User();
            $user = $userModel->findByEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user'] = [
    'id'         => $user['id'],
    'first_name' => $user['first_name'],
    'last_name'  => $user['last_name'],
    'email'      => $user['email'],
    'phone'      => $user['phone'],
    'role'       => $user['role']
];

                if ($user['role'] === 'admin') {
    header('Location: ?page=dashboard');
    exit;
}

header('Location: ?page=home');
exit;
            } else {
                echo "Email ou mot de passe incorrect";
                return;
            }
        }

        require_once __DIR__ . '/../views/login.php';
    }
    public function logout()
    {
    session_destroy();
    header('Location: ?page=home');
    exit;
    }
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $firstName = $_POST['first_name'];
            $lastName = $_POST['last_name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
$address = $_POST['address'];
$postalCode = $_POST['postal_code'];
$city = $_POST['city'];
$password = $_POST['password'];

            $user = new User();
            $user->create($firstName, $lastName, $email, $password, $phone, $address, $postalCode, $city);

            echo "Compte créé avec succès 🎉";
            return;
        }

        require_once __DIR__ . '/../views/register.php';
    }
}
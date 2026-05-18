<?php

class DashboardController
{
    public function index()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ?page=login');
            exit;
        }

        require_once __DIR__ . '/../views/dashboard.php';
    }
}
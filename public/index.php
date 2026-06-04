<?php
session_start();

require_once __DIR__ . '/../core/Router.php';

$router = new Router();
$router->dispatch();
date_default_timezone_set('Europe/Paris');
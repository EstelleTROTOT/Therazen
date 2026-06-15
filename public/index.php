<?php

date_default_timezone_set('Europe/Paris');

session_start();

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(
    dirname(__DIR__)
);

$dotenv->load();

require_once __DIR__ . '/../core/Router.php';

$router = new Router();
$router->dispatch();
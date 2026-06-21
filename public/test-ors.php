<?php

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(
    dirname(__DIR__)
);

$dotenv->load();

$config = require __DIR__ . '/../config/openrouteservice.php';

echo '<pre>';
print_r($config);
echo '</pre>';
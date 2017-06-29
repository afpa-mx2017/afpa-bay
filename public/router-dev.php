<?php

//this script should be executed as a router file (php -S localhost:8000 routes-dev.php)
if (preg_match('/\.(?:png|jpg|jpeg|gif|js|css)$/', $_SERVER["REQUEST_URI"])) {
    return false;
} else {
    include __DIR__ . '/index.php';
}
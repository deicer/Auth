<?php

namespace Auth;

ini_set('error_reporting', E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);


// Автозагрузка PSR-4
require 'vendor/autoload.php';


session_start();

// Узнаем путь с которого пришел запрос
$uri = $_SERVER['REQUEST_URI'];

// Создаем роутер для обработки запроса
$router = new Router($uri);

// Обработка запроса
$router->run();


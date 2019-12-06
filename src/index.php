<?php

namespace Auth;

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);


// Автозагрузка PSR-4
use Auth\services\Db;

require 'vendor/autoload.php';

// Подключаем файл конфигурации
require 'app/configs/config.php';

// Подключаем список маршрутов
require 'app/configs/routes.php';

session_start();

// Узнаем путь с которого пришел запрос
$uri = $_SERVER['REQUEST_URI'];

// Создаем роутер для обработки запроса
$router = new Router($uri);

// Обработка запроса
$router->run();


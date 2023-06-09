<?php

use app\controllers\AuthController;
use app\core\Application;
use app\controllers\SiteController;

$root_dir = dirname(__DIR__);

require_once $root_dir . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable($root_dir);
$dotenv->load();

$config = [
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ]
];

$app = new Application($root_dir, $config);

$app->router->get('/', [SiteController::class ,'home']);
$app->router->get('/contact', [SiteController::class, 'contact']);
$app->router->post('/contact', [SiteController::class, 'handleContact']);

$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);
$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);

$app->run();

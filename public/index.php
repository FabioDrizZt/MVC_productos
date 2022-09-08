<?php

use app\controllers\ProductController;
use app\Router;

require_once '../vendor/autoload.php';

$database = new \app\Database();
$router = new Router($database);

$router->get('/', [ProductController::class, 'index']);
$router->get('/productos', [ProductController::class, 'index']);
$router->get('/productos/crear', [ProductController::class, 'crear']);
$router->post('/productos/crear', [ProductController::class, 'crear']);
$router->get('/productos/actualizar', [ProductController::class, 'actualizar']);
$router->post('/productos/actualizar', [ProductController::class, 'actualizar']);
$router->post('/productos/borrar', [ProductController::class, 'borrar']);

$router->resolve();
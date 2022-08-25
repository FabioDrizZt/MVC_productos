<?php

require_once '../vendor/autoload.php';

use app\Router;
use app\controllers\ProductController;

$router = new Router();

$router->get('/', [ProductController::class, 'index']);
$router->get('/productos', [ProductController::class, 'index']);
$router->get('/productos/crear', [ProductController::class, 'crear']);
$router->post('/productos/crear', [ProductController::class, 'crear']);
$router->get('/productos/editar', [ProductController::class, 'editar']);
$router->post('/productos/editar', [ProductController::class, 'editar']);
$router->post('/productos/borrar', [ProductController::class, 'borrar']);

$router->resolve();
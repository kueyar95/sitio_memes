<?php

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\PostController;

$router = new Router();

$router->get('/admin', [PostController::class, 'index']);
$router->get('/post/crear', [PostController::class, 'crear']);
$router->get('/post/editar', [PostController::class, 'editar']);

$router->comprobarRutas();
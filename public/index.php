<?php

require_once __DIR__ . '/../includes/app.php';

use Controllers\LoginController;
use Controllers\PaginasController;
use MVC\Router;
use Controllers\PostController;
use Controllers\UsuarioController;

$router = new Router();

//Zona privada
$router->get('/posts/admin', [PostController::class,'index']);
$router->get('/posts/crear', [PostController::class,'crear']);
$router->post('/posts/crear', [PostController::class,'crear']);
$router->get('/posts/editar', [PostController::class,'editar']);
$router->post('/posts/editar', [PostController::class,'editar']);
$router->post('/posts/eliminar', [PostController::class,'eliminar']);

$router->post('/usuarios/contRegistro', [UsuarioController::class,'contRegistro']);
$router->get('/usuarios/contRegistro', [UsuarioController::class,'contRegistro']);
$router->get('/usuarios/crear', [UsuarioController::class,'crear']);
$router->post('/usuarios/crear', [UsuarioController::class,'crear']);
$router->get('/usuarios/editar', [UsuarioController::class,'editar']);
$router->post('/usuarios/editar', [UsuarioController::class,'editar']);
$router->post('/usuarios/eliminar', [UsuarioController::class,'eliminar']);

//Zonas pública
$router->get('/', [PaginasController::class, 'index']);
$router->get('/explorar', [PaginasController::class, 'explorar']);
$router->get('/donar', [PaginasController::class, 'donar']);
$router->get('/nsfw', [PaginasController::class, 'nsfw']);
$router->get('/chat', [PaginasController::class, 'chat']);
$router->post('/chat', [PaginasController::class, 'chat']);



//Autentificación y login

$router->get('/login', [LoginController::class, 'login']);
$router->post('/login', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);


$router->comprobarRutas();

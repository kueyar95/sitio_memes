<?php
session_start();
require 'includes/app.php';
//Importante: Los requires e include se hacen en base al index del directorio raíz

use App\Usuario;

//Instanciar la clase Usuario
$usuario = new Usuario;

//Arreglo con errores
$errores = Usuario::getErrores();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = new Usuario($_POST['usuario']);
    $nombreUsuario = $usuario->nombreUsuario;
    $_SESSION['usuario'] = $nombreUsuario;
    $_SESSION['login'] = true;
    $usuario->guardar();
}

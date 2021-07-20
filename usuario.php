<?php 
//Importar conexión
require 'includes/config/database.php';
$db = conectarDb();


//Crear un email y password
$correo = 'correo@correo.com';
$nombreUsuario = 'usuario_1';
$password = '123456';

$passwordHash = password_hash($password, PASSWORD_DEFAULT);

//Query para crear el usuario
$query = "INSERT INTO usuarios (nombreUsuario,claveUsuario,email) VALUES ('${nombreUsuario}','${passwordHash}','${correo}');";

//Agregarlo a la base de datos
mysqli_query($db,$query);


?>
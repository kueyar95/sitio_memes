<?php
    require 'funciones.php';
    require 'config/database.php';
    require __DIR__ . '/../vendor/autoload.php';

    //Conectarnos a la base de datos
    $db = conectarDb();

    use Models\ActiveRecord;

    ActiveRecord::setDB($db);

    //$publicacion = new Post();
    //echo "<pre>";
    //var_dump($publicacion);
    //echo "</pre>";
?>
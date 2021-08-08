<?php
    define('TEMPLATES_URL', __DIR__ . '/layout');
    define('FUNCIONES_URL', __DIR__ . 'funciones.php');
    define('CARPETA_IMG', __DIR__ . '/../imagenes/');

    function incluirTemplate(string $nombre, bool $inicio = false)
    {
        include TEMPLATES_URL . "/${nombre}.php";
    }

    function estaAutenticado(){
        session_start();

        if(!$_SESSION['login']) {
            header('Location: /Sitio_memes/');    
        } 
    }

    function debuguear($variable){
         echo "<pre>";
         var_dump($variable);
         echo "</pre>";
         exit;
    }
    
    //Escapar el HTML
    function sanitizar($html) : string{
        $sanitizar = htmlspecialchars($html);
        return $sanitizar;
    }
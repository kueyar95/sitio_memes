<?php
define('TEMPLATES_URL', __DIR__ . '/layout');
define('FUNCIONES_URL', __DIR__ . 'funciones.php');
define('CARPETA_IMG', $_SERVER['DOCUMENT_ROOT'] . '/imagenes/');
define('CARPETA_IMG_PERFIL', $_SERVER['DOCUMENT_ROOT'] . '/imagenesPerfil/');


function incluirTemplate(string $nombre, bool $inicio = false)
{
    include TEMPLATES_URL . "/${nombre}.php";
}

function estaAutenticado()
{
    session_start();

    if (!$_SESSION['login']) {
        header('Location: /Sitio_memes/');
    }
}

function debuguear($variable)
{
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

//Escapar el HTML
function sanitizar($html): string
{
    $sanitizar = htmlspecialchars($html);
    return $sanitizar;
}

//Notificaciones
function mostrarNotificaciones($codigo)
{
    $notificacion = '';

    switch ($codigo) {
        case 1:
            $notificacion = 'Creado correctamente';
            break;
        case 2:
            $notificacion = 'Actualizado correctamente';
            break;
        case 3:
            $notificacion = 'Eliminado correctamente';
            break;
        default:
            $notificacion = false;
            break;
    }
    return $notificacion;
}

//Validar o redireccionar
function validarORedireccionar(string $url)
{
    //Validar id
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if (!$id) {
        header("Location: ${url}");
    }
    return $id;
}

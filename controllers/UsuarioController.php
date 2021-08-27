<?php

namespace Controllers;

use MVC\Router;
use Models\Usuario;

class UsuarioController
{
    public static function contRegistro(Router $router){
        $errores = Usuario::getErrores();
        $usuario = new Usuario;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $usuario = new Usuario($_POST['usuario']);
        $errores = $usuario->validar();
        $router->render('usuarios/contRegistro', [
            'errores' => $errores,
            'usuario' => $usuario

        ]);
    }}
    public static function crear(Router $router)
    {
        $errores = Usuario::getErrores();
        $usuario = new Usuario;
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $usuario = new Usuario($_POST['usuario']);
            $nombreUsuario = $usuario->nombreUsuario;
            /**Subida de archivos */
            //Generar nombre único para cada archivo
            $nombreUnico = md5(uniqid(rand(), true)) . '.jpg';
            
            //Asignar files a una variable
            $archivoPost = $_FILES['usuario'];
            
            $usuario->imagenPerfil = $nombreUnico;

            if ($_FILES['usuario']['tmp_name']['imagenPerfil']) {
                $usuario->setArchivoPost($nombreUnico);
            }
            $errores = $usuario->validar();
            if (empty($errores)) {
                $_SESSION['usuario'] = $nombreUsuario;
                $_SESSION['login'] = true;
                //Subir la imagen
                move_uploaded_file($archivoPost['tmp_name']['imagenPerfil'], CARPETA_IMG_PERFIL . $nombreUnico);
                //Guardar los datos de la publicación creada
                $usuario->guardar();

            }else{
                
            }
        }
    }
    public static function editar()
    {
    }
    public static function eliminar()
    {
    }
}

<?php

namespace Controllers;

use MVC\Router;
use Models\Post;
use Models\Usuario;

class PostController
{
    public static function index(Router $router)
    {
        $posts = Post::all();
        
        //Muestra mensaje condicional
        $resultado = $_GET['resultado'] ?? null;

        $router->render('posts/admin', [
            'posts' => $posts,
            'resultado' => $resultado,
            
        ]);
    }
    public static function crear(Router $router)
    {
        $publicacion = new Post;
        //Arreglo con errores
        $errores = Post::getErrores();
        //Método POST para crear
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            /**Subida de archivos */
            //Generar nombre único para cada archivo
            $nombreUnico = md5(uniqid(rand(), true)) . '.jpg';

            //Asignar files a una variable
            $archivoPost = $_FILES['publicacion'];

            //Obtener el nombre del archivo y luego agregarlo a $_POST
            $nombreArchivo = $archivoPost['name']['archivoPost'];

            //Guardar en $_POST el nombre de usuario desde $_SESSION
            $_POST['publicacion']['nombreUsuarioPost'] = 'kueyar';

            //Instanciar la clase post
            $publicacion = new Post($_POST['publicacion']);

            if ($_FILES['publicacion']['tmp_name']['archivoPost']) {
                $publicacion->setArchivoPost($nombreUnico);
            }
            //Validar los datos
            $errores = $publicacion->validar();
            //Revisar que el arreglo de errores esté vacío
            if (empty($errores)) {

                if (!is_dir(CARPETA_IMG)) {
                    mkdir(CARPETA_IMG);
                }

                //Subir la imagen
                move_uploaded_file($archivoPost['tmp_name']['archivoPost'], CARPETA_IMG . $nombreUnico);
                //Guardar los datos de la publicación creada

                $publicacion->guardar();
            }
        }
        $router->render('posts/crear', [
            'publicacion' => $publicacion,
            'errores' => $errores
        ]);
    }
    public static function editar(Router $router)
    {
        $id = validarORedireccionar('/posts/admin');

        $publicacion = Post::find($id);
        //Arreglo con errores
        $errores = Post::getErrores();
        //Método POST para editar
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            //Asignar los atributos
            $args = $_POST['publicacion'];

            /**Subida de archivos */
            //Generar nombre único para cada archivo
            $nombreUnico = md5(uniqid(rand(), true)) . '.jpg';

            //Instanciar la clase post
            $publicacion->updatePost($args);

            //Validar los datos
            $errores = $publicacion->validar();

            if ($_FILES['publicacion']['tmp_name']['archivoPost']) {
                $publicacion->setArchivoPost($nombreUnico);
            }

            //Revisar que el arreglo de errores esté vacío
            if (empty($errores)) {
                //Subir la imagen
                move_uploaded_file($_FILES['publicacion']['tmp_name']['archivoPost'], CARPETA_IMG . $nombreUnico);
                //Guardar los datos de la publicación creada
                $resultado = $publicacion->guardar();
            }
        }
        $router->render('/posts/editar', [
            'publicacion' => $publicacion,
            'errores' => $errores
        ]);
    }
    public static function eliminar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if ($id) {
                $publicacion = Post::find($id);

                $publicacion->eliminar();
            }
        }
    }
}

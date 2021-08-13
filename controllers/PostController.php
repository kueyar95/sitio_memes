<?php

namespace Controllers;
use MVC\Router;

class PostController{
    public static function index(Router $router){
        $router->render('post/admin');
    }
    public static function crear(){
        echo 'Creando post';
    }
    public static function editar($view){
        echo 'Editando post';
    }
}
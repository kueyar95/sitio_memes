<?php

namespace App;

class Post
{
    //Base de datos
    protected static $db;
    protected static $columnasDB = ['id', 'nombreUsuarioPost', 'horaPost', 'descripcion', 'archivoPost', 'categoria', 'tags', 'votosPositivos', 'votosNegativos', 'comentarios', 'compartidos'];

    //Errores
    protected static $errores = [];

    public $id;
    public $nombreUsuarioPost;
    public $horaPost;
    public $descripcion;
    public $archivoPost;
    public $categoria;
    public $tags;
    public $votosPositivos;
    public $votosNegativos;
    public $comentarios;
    public $compartidos;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? '';
        $this->nombreUsuarioPost = $args['nombreUsuarioPost'] ?? '';
        $this->horaPost = date('d-m-Y H:i:s');
        $this->descripcion = $args['descripcionPost'] ?? '';
        $this->archivoPost = $args['archivoPost'] ?? '';
        $this->categoria = $args['categoria'] ?? '';
        $this->tags = $args['tags'] ?? '';
        $this->checkSensitivo = $args['checkSensitivo'] ?? '0';
        $this->votosPositivos = $args['votosPositivos'] ?? '0';
        $this->votosNegativos = $args['votosNegativos'] ?? '0';
        $this->comentarios = $args['comentarios'] ?? '0';
        $this->compartidos = $args['compartidos'] ?? '0';
    }
    //Definir la conexión a la base de datos
    public static function setDB($database)
    {

        //Self es parecido a $this pero cuando es static
        self::$db = $database;
    }

    public function guardar()
    {
        //Sanitizar los datos
        $datos = $this->sanitizarDatos();

        $string_keys = join(', ',array_keys($datos));
        $string_values = join("', '",array_values($datos));
        //Insertar en la base de datos
        $query = "INSERT INTO posts (${string_keys}) VALUES ('${string_values}')";
        $resultado = self::$db->query($query);
        if ($resultado) {
            header('Location: ../index.php?resultado=1');
        }
    }
    //Identificar y unir los datos de la BD
    public function datos()
    {
        $datos = [];
        foreach (self::$columnasDB as $columna) {
            if($columna === 'id') continue;
            $datos[$columna] = $this->$columna;
        }
        return $datos;
    }

    public function sanitizarDatos()
    {
        $datos = $this->datos();
        $sanitizado = [];
        
        foreach ($datos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }

    //Validación
    public static function getErrores(){
        return self::$errores;
    }

    public function validar(){
        
    
        if (!$this->descripcion) {
            self::$errores[] = 'Debes añadir una descripción';
        }
        if (!$this->tags) {
            self::$errores[] = 'Debes añadir mínimo un tag';
        }
        if (!$this->archivoPost) {
            self::$errores[] = "El contenido de la publicación es obligatoria";
        }
        return self::$errores;
    }
}

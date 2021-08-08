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
        $this->descripcion = $args['descripcion'] ?? '';
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

    public function guardar(){
        if($this->id){
            $this->actualizar();
    } else{
        $this->crear();
    }
    }
    //CREAR PUBLICACION
    public function crear()
    {
        //Sanitizar los datos
        $datos = $this->sanitizarDatos();

        $string_keys = join(', ', array_keys($datos));
        $string_values = join("', '", array_values($datos));
        //Insertar en la base de datos
        $query = "INSERT INTO posts (${string_keys}) VALUES ('${string_values}')";
        $resultado = self::$db->query($query);

        //Se coloca return $resultado para que le llegue a crear.php y pueda agarrar la variable para redirigir a index.php
        return $resultado;
    }
    //ACTUALIZAR PUBLICACION
    public function actualizar(){
        //Sanitizar los datos
        $datos = $this->sanitizarDatos();
        $valores = [];
        foreach ($datos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }

        $query = "UPDATE posts SET join(', ', ${valores}) WHERE id = '" . self::$db->escape_string($this->id) . "' LIMIT 1 ";
        $resultado = self::$db->query($query);

        return $resultado;
    }
    //ELIMINAR PUBLICACION
    public function eliminar(){
        
    }
    //Identificar y unir los datos de la BD
    public function datos()
    {
        $datos = [];
        foreach (self::$columnasDB as $columna) {
            if ($columna === 'id') continue;
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
    //Imagen
    public function setArchivoPost($archivoPost)
    {
        //Elimina la imagen previa si existe
        if(isset($this->id)){
            //Comprobar si existe archivo
            $existeArch = file_exists(CARPETA_IMG . $this->archivoPost);
            if($existeArch) {
                unlink(CARPETA_IMG . $this->archivoPost);
            }
        }
        //Asignar al atributo archivoPost el nombre del archivo
        if ($archivoPost) {
            $this->archivoPost = $archivoPost;
        }
    }

    //Validación
    public static function getErrores()
    {
        return self::$errores;
    }

    public function validar()
    {
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
    //Lista todas las publicaciones
    public static function all()
    {
        $query = "SELECT * FROM posts";
        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    //Busca una publicación por su id
    public static function find($id)
    {
        //Obtener los datos de la publicación
        $query = "SELECT * FROM posts WHERE id = ${id}";
        $resultado = self::consultarSQL($query);

        //El arreglo que necesitaba estaba en la posición [0], "array_shift" sirve para eso
        return array_shift($resultado);
    }

    public static function consultarSQL($query)
    {
        //Consultar base de datos
        $resultado = self::$db->query($query);
        //Iterar los resultados
        $array_post = [];
        while ($registro = $resultado->fetch_assoc()) {
            $array_post[] = self::crearObjeto($registro);
        }
        //Liberar memoria
        $resultado->free();
        //Retornar resultados
        return $array_post;
    }

    protected static function crearObjeto($registro)
    {
        //Se crea una instancia de la clase con "new self"
        $objeto = new self;

        foreach ($registro as $key => $value) {
            //property_exists compara los atributos del objeto con los keys del arreglo que recibe
            if (property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }

    //Sincronizar los datos en memoria con los cambios realizados por el usuario
    public function updatePost($args = []){
        foreach ($args as $key => $value) {
            if(property_exists($this, $key) && !is_null($value)){
                $this->$key = $value;
            }
        }
    }
}

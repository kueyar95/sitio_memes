<?php

namespace Models;

class ActiveRecord {
    //Base de datos
    protected static $db;
    protected static $columnasDB = [];
    protected static $tabla = '';
    //Errores
    protected static $errores = [];

    //Definir la conexión a la base de datos
    public static function setDB($database)
    {
        //Self es parecido a $this pero cuando es static
        self::$db = $database;
    }

    public function guardar(){
        $resultado = '';
        if(!is_null($this->id)){
            $resultado = $this->actualizar();
    } else{
        $resultado = $this->crear();
    }
        return $resultado;
    }
    //CREAR PUBLICACION
    public function crear()
    {
        //Sanitizar los datos
        $datos = $this->sanitizarDatos();

        $string_keys = join(', ', array_keys($datos));
        $string_values = join("', '", array_values($datos));
        //Insertar en la base de datos
        $query = "INSERT INTO " . static::$tabla . " (${string_keys}) VALUES ('${string_values}')";
        $resultado = self::$db->query($query);

        if ($resultado) {
            header('Location: admin\index.php?resultado=1');
        }
    }
    //ACTUALIZAR PUBLICACION
    public function actualizar(){
        //Sanitizar los datos
        $datos = $this->sanitizarDatos();
        $valores = [];
        foreach ($datos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }

        $query = "UPDATE " . static::$tabla . " SET " . join(', ', $valores) . " WHERE id = '" . self::$db->escape_string($this->id) . "' LIMIT 1 ";
        $resultado = self::$db->query($query);

        if ($resultado) {
            header('Location: ../index.php?resultado=2');
        }
    }
    //ELIMINAR PUBLICACION
    public function eliminar(){
        $query = "DELETE FROM posts WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);

        if ($resultado) {
            $this->borrarArch();
            header('Location: /Sitio_memes/admin?resultado=3');
        }
    }
    //Identificar y unir los datos de la BD
    public function datos()
    {
        $datos = [];
        foreach (static::$columnasDB as $columna) {
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
    //ELIMINAR ARCHIVO
    public function borrarArch(){
        //Comprobar si existe archivo
        $existeArch = file_exists(CARPETA_IMG . $this->archivoPost);
        if($existeArch) {
            $resultado = unlink(CARPETA_IMG . $this->archivoPost);
        }
    }
    //IMAGEN
    public function setArchivoPost($archivoPost)
    {
        //Elimina la imagen previa si existe
        if(!is_null($this->id)){
            $this->borrarArch();
        }
        //Asignar al atributo archivoPost el nombre del archivo
        if ($archivoPost) {
            $this->archivoPost = $archivoPost;
        }
    }

    public static function getErrores()
    {
        return static::$errores;
    }
    //VALIDACION
    public function validar()
    {
        static::$errores = [];
        return static::$errores;
    }
    //Lista todas las publicaciones
    public static function all()
    {
        $query = "SELECT * FROM " . static::$tabla;
        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    //Busca una publicación por su id
    public static function find($id)
    {
        //Obtener los datos de la publicación
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = ${id}";
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

    //Crea una instancia del objeto con la información obtenida de la BD
    protected static function crearObjeto($registro)
    {
        //Se crea una instancia de la clase con "new self"
        $objeto = new static;

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
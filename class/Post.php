<?php

namespace App;

class Post extends ActiveRecord
{
    protected static $tabla = 'posts';
    protected static $columnasDB = ['id', 'nombreUsuarioPost', 'horaPost', 'descripcion', 'archivoPost', 'categoria', 'tags', 'votosPositivos', 'votosNegativos', 'comentarios', 'compartidos'];

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
        $this->id = $args['id'] ?? null;
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
}

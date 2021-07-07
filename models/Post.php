<?php 
namespace Model;

class Post{
    public $id;
    public $nombreUsuarioPost;
    public $horaPost;
    public $tituloPost;
    public $contenido;
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
        $this->horaPost = $args['horaPost'] ?? '';
        $this->tituloPost = $args['tituloPost'] ?? '';
        $this->contenido = $args['contenido'] ?? '';
        $this->categoria = $args['categoria'] ?? '';
        $this->tags = $args['tags'] ?? '';
        $this->votosPositivos = $args['votosPositivos'] ?? '';
        $this->votosNegativos = $args['votosNegativos'] ?? '';
        $this->comentarios = $args['comentarios'] ?? '';
        $this->compartidos = $args['compartidos'] ?? '';

    }
}


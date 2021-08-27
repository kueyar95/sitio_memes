<?php

namespace Models;

class Usuario extends ActiveRecord
{
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id','nombreUsuario','claveUsuario','email','imagenPerfil','fechaRegistro'];

    public $id;
    public $nombreUsuario;
    public $claveUsuario;
    public $email;
    public $imagenPerfil;
    public $fechaRegistro;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombreUsuario = $args['nombreUsuario'] ?? '';
        $this->claveUsuario = $args['claveUsuario'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->imagenPerfil = $args['imagenPerfil'] ?? 'imagen';
        $this->fechaRegistro = date('d-m-Y H:i:s');
    }

    public function validar()
    {
        if (!$this->nombreUsuario) {
            self::$errores[] = 'Debes añadir una nombre de usuario';
        }
        if (!$this->claveUsuario) {
            self::$errores[] = 'Debes crear una contraseña';
        }
        if (!$this->email) {
            self::$errores[] = "Debes agregar un email válido";
        }
        return self::$errores;
    }
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
            header('Location: /posts/admin?resultado=1');
        }
    }
}


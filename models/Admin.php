<?php
    namespace Models;

    class Admin extends ActiveRecord {
        protected static $tabla = 'admin';
        protected static $columnasDB = ['id', 'nombre', 'rol', 'usuario', 'password'];

        public $id;
        public $nombre;
        public $rol;
        public $usuario;
        public $password;

        public function __construct($args = []){
            $this->id = $args['id'] ?? null;
            $this->nombre = $args['nombre'] ?? null;
            $this->rol = $args['rol'] ?? null;
            $this->usuario = $args['usuario'] ?? null;
            $this->password = $args['password'] ?? null; 
        }

        public function validar () {
            if(!$this->nombre){
                self::$errores[] = 'El nombre no puede ser nulo';
            }
        }

    }
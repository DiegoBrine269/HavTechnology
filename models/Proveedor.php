<?php
    namespace Models;

    class Proveedor extends ActiveRecord {
        protected static $tabla = 'proveedor';
        protected static $columnasDB = ['id', 'nombre', 'telefono', 'correo'];

        public $id;
        public $nombre;
        public $telefono;
        public $correo;

        public function __construct($args = []){
            $this->id = $args['id'] ?? null;
            $this->nombre = $args['nombre'] ?? null;
            $this->telefono = $args['telefono'] ?? null;
            $this->correo = $args['correo'] ?? null;
        }

        public function validar () {
            if(!$this->nombre){
                self::$errores[] = 'El nombre no puede ser nulo';
            }
        }

    }
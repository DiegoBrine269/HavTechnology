<?php
    namespace Models;

    class Cliente extends ActiveRecord {
        protected static $tabla = 'cliente';
        protected static $columnasDB = ['id', 'nombre', 'RFC', 'dirFiscal', 'CP', 'usoCFDI', 'correo'];

        public $id;
        public $nombre;
        public $RFC;
        public $dirFiscal;
        public $CP;
        public $usoCFDI;
        public $correo;

        public function __construct($args = []){
            $this->id = $args['id'] ?? null;
            $this->nombre = $args['nombre'] ?? null;
            $this->RFC = $args['RFC'] ?? null;
            $this->dirFiscal = $args['dirFiscal'] ?? null;
            $this->CP = $args['CP'] ?? null;
            $this->usoCFDI = $args['usoCFDI'] ?? null;
            $this->correo = $args['correo'] ?? null;
        }

        public function validar () {
            if(!$this->nombre){
                self::$errores[] = 'El nombre no puede ser nulo';
            }
        }
    }
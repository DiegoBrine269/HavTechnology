<?php
    namespace Models;

    class Venta extends ActiveRecord {
        protected static $tabla = 'venta';
        protected static $columnasDB = ['id', 'nombre', 'total', 'fecha'];

        public $id;
        public $nombre;
        public $total;
        public $fecha;

        public function __construct($args = []){
            $this->id = $args['id'] ?? null;
            $this->nombre = $args['nombre'] ?? null;
            $this->total = $args['total'] ?? null;
            $this->fecha = $args['fecha'] ?? null;
        }

        public function validar () {
            if(!$this->nombre){
                self::$errores[] = 'El nombre no puede ser nulo';
            }
        }


        public static function all(){
            $query = "SELECT V.id, C.nombre, CONCAT('$', V.total) AS 'total', DATE_FORMAT(V.fecha, '%d/%m/%Y') AS 'fecha' FROM Venta AS V, Cliente AS C
            WHERE V.idCliente = C.id ORDER BY V.id;"; //static: Usa el valor que tenga el atributo de la clase que herede
            $resultado = self::consultarSQL($query);

            return $resultado;
        }
    }
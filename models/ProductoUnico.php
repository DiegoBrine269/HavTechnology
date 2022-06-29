<?php
    namespace Models;

    class ProductoUnico extends ActiveRecord {
        protected static $tabla = 'productounico';
        protected static $columnasDB = ['id', 'idUnico', 'existe', 'idProveedor'];

        public $id;
        public $idUnico;
        public $existe;
        public $idProveedor;

        public function __construct($args = []){
            $this->id = $args['id'] ?? null;
            $this->idUnico = $args['idUnico'] ?? null;
            $this->existe = $args['existe'] ?? null;
            $this->idProveedor = $args['idProveedor'] ?? null; 
        }

        public function validar () {
            if(!$this->id){
                self::$errores[] = 'El id no debe ser nulo';
            }

            if(!$this->idUnico){
                self::$errores[] = 'El producto debe tener un id único';
            }

            if(!$this->idProveedor){
                self::$errores[] = 'El producto debe tener un proveedor';
            }

            return self::$errores;
        }

        
        public function crear(){
            //Santizar los datos
            $atributos = $this->sanitizarAtributos();
            
            //Insertamos en la base de datos
            $query = "INSERT INTO ProductoUnico VALUES ('". $this->id ."', '".$this->idUnico."', '".$this->existe."', '".$this->idProveedor."');";
            

            $resultado = self::consultarSQL($query);

            return $resultado;
        }

        public static function ultimoID ($id) {
            $query = "SELECT REPLACE(MAX(idUnico), '" . $id . "', '')  FROM ProductoUnico WHERE id = '" . $id . "';";
            $resultado = self::$db->query($query);
            $resultado = $resultado->fetch_array();

            return $resultado;
        }
    }
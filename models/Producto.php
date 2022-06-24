<?php
    namespace Models;

    class Producto extends ActiveRecord {
        protected static $tabla = 'producto';
        protected static $columnasDB = ['id', 'nombre', 'descripcion', 'color', 'lote', 'stock', 'nombreProveedor'];

        public $id;
        public $nombre;
        public $descripcion;
        public $color;
        public $lote;
        public $stock;
        public $nombreProveedor;
        public $idProveedor;

        public function __construct($args = []){
            $this->id = $args['id'] ?? null;
            $this->nombre = $args['nombre'] ?? null;
            $this->descripcion = $args['descripcion'] ?? null;
            $this->color = $args['color'] ?? null;
            $this->lote = $args['lote'] ?? null; 
            $this->stock = $args['stock'] ?? null; 
            $this->nombreProveedor = $args['nombreProveedor'] ?? null;
            $this->idProveedor = $args['idProveedor'] ?? null; 
        }

        public function validar () {
            if(!$this->nombre){
                self::$errores[] = 'El nombre no puede ser nulo';
            }
        }

        public static function all(){
            $query = "SELECT P.id, P.nombre, P.descripcion, P.color, P.lote, P.stock, Prov.nombre AS 'nombreProveedor' FROM Producto P, ProductoUnico PU, Proveedor Prov
            WHERE P.id = PU.id AND PU.idProveedor = Prov.id;"; //static: Usa el valor que tenga el atributo de la clase que herede
            $resultado = self::consultarSQL($query);

            return $resultado;
        }

        public function crear(){
            //Santizar los datos
            $atributos = $this->sanitizarAtributos();
            
            //Insertamos en la base de datos
            $query = "INSERT INTO Proveedor VALUES ('". $this->nombre ."', '".$this->telefono."', '".$this->correo."');
            INSERT INTO Producto VALUES ('".$this->id."', '".$this->nombre."', '".$this->descripcion."', '".$this->color."', '".$this->lote."', '".$this->stock."', '".$this->idProveedor."');";

            $resultado = self::$db->query($query);

            //Mensaje de exito o error
            if($resultado){
                //Redireccionamos al usuario
                header('Location: /admin?resultado=1');
            }
        }

    }
<?php
    namespace Models;

    class ActiveRecord{
        //Base de datos
        protected static $db;
        protected static $columnasDB = [];
        protected static $tabla = '';

        //Errores
        protected static $errores = [];

        //Definir conexión a la BD
        public static function setDB ($database){
            self::$db = $database;
        } 

        public function guardar(){
            if(!is_null($this->id)){
                //Actualizar registro existente
                return $this->actualizar();
            }
            else{
                //Crear nuevo registro
                $this->crear();
            }
        }

        public function crear(){
            //Santizar los datos
            $atributos = $this->sanitizarAtributos();
            
            //Insertamos en la base de datos
            $query = "INSERT INTO " . static::$tabla . " ( ";
            $query .=  join(', ', array_keys($atributos));
            $query .= " ) VALUES ( '"; 
            $query .= join("', '", array_values($atributos));
            $query .= "' )";

            $resultado = self::$db->query($query);

            //Mensaje de exito o error
            if($resultado){
                //Redireccionamos al usuario
                header('Location: /admin?resultado=1');
            }
        }

        public function actualizar(){
            //Santizar los datos
            $atributos = $this->sanitizarAtributos();

            $valores = [];

            foreach($atributos as $key => $value){
                $valores[] = "{$key} = '{$value}'";
            }

            $query = "UPDATE " . static::$tabla;
            $query .= " SET ";
            $query .=  join(', ', $valores);
            $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
            $query .= " LIMIT 1";

            $resultado = self::$db->query($query);
            
            if($resultado){
                //Redireccionamos al usuario
                header('Location: /admin?resultado=2');
            }
            return $resultado;
        }

        //Eliminar un registro
        public function eliminar(){
            $query = "DELETE FROM " . static::$tabla ." WHERE id = " . self::$db->escape_string($this->id);
            $resultado = self::$db->query($query);
            if($resultado){
                header('Location: /admin?resultado=3');
            }
        }

        //Identificar y unir los atributos de la BD, los convierte a arreglo
        public function atributos(){
            $atributos = [];

            foreach(static::$columnasDB as $columna){
                if($columna === 'id') continue; //Ignora id
                $atributos[$columna] = $this->$columna;
            }
            return $atributos;
        }

        public function sanitizarAtributos(){
            $atributos = $this->atributos();
            $sanitizado = [];

            foreach($atributos as $key => $value ){
                $sanitizado [$key] = self::$db->escape_string($value); //Sanitizamos el elemento especificado (value)
            }

            return $sanitizado;
        }


        //Validación
        public static function getErrores(){
            return static::$errores;
        }
        
        public function validar () {
            static::$errores = [];
            return static::$errores;
        }

        //Consulta todos los registros
        public static function all(){
            $query = "SELECT * FROM " . static::$tabla; //static: Usa el valor que tenga el atributo de la clase que herede
            $resultado = self::consultarSQL($query);

            return $resultado;
        }

        //Obtiene un número determinado de registros
        public static function get($cantidad){
            $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $cantidad;
            $resultado = self::consultarSQL($query);

            return $resultado;
        }

        //Buscar un registro por su id
        public static function find($id){
            $query = "SELECT * FROM " . static::$tabla . " WHERE id = {$id}";
            $resultado = self::consultarSQL($query);
            return array_shift($resultado); //Retorna la primera posición
        }

        public static function consultarSQL($query){
            //Consultar BD
            $resultado = self::$db->query($query);

            //Iterar los resultados
            $array = [];
            while($registro = $resultado->fetch_assoc()){
                $array[] = static::crearObjeto($registro);
            }

            //Liberar la memoria
            $resultado->free();    

            //Retornar 
            return $array;
        }

        protected static function crearObjeto ($registro){
            $objeto = new static;
            
            foreach($registro as $key => $value){
                if(property_exists($objeto, $key)){
                    $objeto->$key = $value;
                }
            }

            return $objeto;
        }

        //Sincroniza el objeto en memoria con los cambios realizados por el usuario
        public function sincronizar( $args ){
            foreach($args as $key => $value){
                if(property_exists($this, $key) || is_null($value)){
                    $this->$key = $value;
                }
            }
        }
    }
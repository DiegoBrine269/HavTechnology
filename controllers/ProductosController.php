<?php
    namespace Controllers;
    use MVC\Router;
    use Models\Producto;
    use Models\ProductoUnico;
    use Models\Proveedor;

    class ProductosController {
        public static function index (Router $router) {
            $productos = Producto::all();

            $router->render('admin/index', [
                'pagina' => 'Productos',
                'headers' => ['ID (SKU)', 'Nombre', 'Descripción', 'Color', 'Lote', 'Stock', 'Proveedor'],
                'datos' => $productos,
                'autoIncrement' => false
            ]);
        }

        public static function crear (Router $router) {
            $producto = new Producto();
            $productoUnico = new ProductoUnico();
            $proveedores = Proveedor::all();

            if($_SERVER['REQUEST_METHOD'] === 'POST') {

                
                //Instanciamos con parámetro
                $producto = new Producto($_POST['producto']);
                
                //Validar
                $errores = $producto->validar();
                //$errores2 = $productoUnico->validar();

                //Comprobar si no hay errores
                if(empty($errores)) {               

                    
                    //Guardar producto en la BD
                    $resultado = $producto->guardarConID();  

                    
                    //Si se registro el Producto, ahora a registrar los Productos únicos
                    if($resultado) {
                        $cantidadUnicos = $producto->stock;

                        $ultimoID = ProductoUnico::ultimoID($producto->id);

                        debug($ultimoID);
                        
                        for ($i=1 + $ultimoID; $i <= $i + $cantidadUnicos ; $i++) { 
                            $productoUnico = new ProductoUnico([
                                'id' => $producto->id, 
                                'idUnico' => $producto->id . $i,
                                'existe' => '1',
                                'idProveedor' => $producto->idProveedor
                            ]);


                            $productoUnico->crear();
                        }
                    }
                    
                    
                }
            } 
            
            $router->render('productos/crear', [
                'pagina' => 'Registrar un nuevo producto',
                'proveedores' => $proveedores
            ]);
        }

        public static function visualizar (Router $router) {
            $id = $_GET['id'];

            $producto = Producto::find($id);
            $productosUnicos = ProductoUnico::findAll($id);

            //Obtener número de proveedores diferentes
            $numProveedores = 1;
            $idProveedor = $productosUnicos[0]->idProveedor;
            $proveedores = []; 

            foreach($productosUnicos as $productoUnico) {
                if($productoUnico->idProveedor !== $idProveedor){
                    $numProveedores++;
                }
                //Obtenemos todos los proveedores posibles
                array_push($proveedores, Proveedor::find($productoUnico->idProveedor));
                
            }

            $router->render('productos/visualizar', [
                'pagina' => 'Producto :' 
            ]);
        }
    }
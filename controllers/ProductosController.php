<?php
    namespace Controllers;
    use MVC\Router;
    use Models\Producto;
    use Models\Proveedor;

    class ProductosController {
        public static function index (Router $router) {
            $productos = Producto::all();

            //debug($productos);

            $router->render('admin/index', [
                'pagina' => 'Productos',
                'headers' => ['ID (SKU)', 'Nombre', 'Descripción', 'Color', 'Lote', 'Stock', 'Proveedor'],
                //'atributos' => ['id', 'nombre', 'descripcion', 'color', 'lote', 'stock', 'idProveedor'],
                'datos' => $productos,
                'autoIncrement' => false
            ]);
        } 

        public static function crear (Router $router) {
            $producto = new Producto();
            $proveedores = Proveedor::all();

            $router->render('productos/crear', [
                'pagina' => 'Registrar un nuevo producto',
                'proveedores' => $proveedores
            ]);
        }


    }
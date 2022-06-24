<?php
    namespace Controllers;
    use MVC\Router;
    use Models\Producto;

    class ProductosController {
        public static function index (Router $router) {
            $productos = Producto::all();

            //debug($productos);

            $router->render('admin/index', [
                'pagina' => 'Productos',
                'headers' => Producto::getColumnasDB(),
                'labels' => ['ID (SKU)', 'Nombre', 'Descripción', 'Color', 'Lote', 'Stock', 'Proveedor'],
                'atributos' => ['id', 'nombre', 'descripcion', 'color', 'lote', 'stock', 'idProveedor'],
                'modalTitulo' => 'Registrar un nuevo producto',
                'datos' => $productos,
                'autoIncrement' => false
            ]);
        } 

        public static function registrar (Router $router) {
            $producto = new Producto();
        }


    }
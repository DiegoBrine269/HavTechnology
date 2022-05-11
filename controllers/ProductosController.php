<?php
    namespace Controllers;
    use MVC\Router;

    class ProductosController {
        public static function index (Router $router) {
            $router->render('admin/index', [
                'pagina' => 'Productos',
                'headers' => ['Sel', 'ID', 'Imagen', 'Nombre', 'Descripción', 'Stock']
            ]);
        } 
    }
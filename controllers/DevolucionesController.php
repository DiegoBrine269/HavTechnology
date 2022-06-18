<?php
    namespace Controllers;
    use MVC\Router;

    class DevolucionesController {
        public static function index (Router $router) {
            $router->render('admin/index', [
                'pagina' => 'Devoluciones',
<<<<<<< HEAD
                'headers' => ['Sel', 'Producto', 'Número de venta', 'Pérdida total']
=======
                'headers' => ['Sel', 'ID', 'Imagen', 'Nombre', 'Descripción', 'Stock']
>>>>>>> 5318301ca3f94d3cf9c912ad91afc52bcbe114d5
            ]);
        } 
    }
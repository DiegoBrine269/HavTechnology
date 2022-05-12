<?php
    namespace Controllers;
    use MVC\Router;

    class DevolucionesController {
        public static function index (Router $router) {
            $router->render('admin/index', [
                'pagina' => 'Devoluciones',
                'headers' => ['Sel', 'ID', 'Imagen', 'Nombre', 'Descripción', 'Stock']
            ]);
        } 
    }
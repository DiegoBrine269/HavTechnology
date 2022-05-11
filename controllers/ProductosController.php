<?php
    namespace Controllers;
    use MVC\Router;

    class ProductosController {
        public static function index (Router $router) {
            $router->render('productos/index', [
                'pagina' => 'Productos'
            ]);
        } 

        public static function login (Router $router) {
            $router->render('login');
        } 
    }
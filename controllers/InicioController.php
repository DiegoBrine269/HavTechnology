<?php
    namespace Controllers;
    use MVC\Router;

    class InicioController {
        public static function index (Router $router) {
            $router->render('inicio', [
                'usuario' => 'Horacio'
            ]);
        } 

        public static function login (Router $router) {
            $router->render('login');
        } 
    }
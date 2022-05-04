<?php
    namespace Controllers;
    use MVC\Router;

    class InicioController {
        public static function index (Router $router) {
            $router->render('inicio', [
                'nombre' => 'Alan',
                'correo' => 'alan@gmail.com'
            ]);
        } 

        public static function login (Router $router) {
            $router->render('login');
        } 
    }
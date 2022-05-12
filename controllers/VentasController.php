<?php
    namespace Controllers;
    use MVC\Router;

    class VentasController {
        public static function index (Router $router) {
            $router->render('admin/index', [
                'pagina' => 'Ventas',
                'headers' => ['Sel', 'Fecha', 'Cliente', 'Subtotal', 'Total']
            ]);
        } 
    }
<?php
    namespace Controllers;
    use MVC\Router;
    use Models\Venta;

    class VentasController {
        public static function index (Router $router) {
            $ventas = Venta::all();

            //debug($ventas);

            $router->render('admin/index', [
                'pagina' => 'Ventas',
                'headers' => Venta::getColumnasDB(),
                'modalTitulo' => 'Registrar una nueva venta',
                'datos' => $ventas
            ]);
        } 

        public static function crear (Router $router) {
            $venta = new Venta();

            $router->render('ventas/crear', [
                'pagina' => 'Registrar una nueva venta'
            ]);
        }
    }
<?php
    namespace Controllers;
    use MVC\Router;

    class DevolucionesController {
        public static function index (Router $router) {
            $router->render('admin/index', [
                'pagina' => 'Devoluciones',
                'headers' => Devolucion::getColumnasDB(),
                'modalTitulo' => 'Registrar una pérdida'
            ]);
        } 
    }
<?php
    namespace Controllers;
    use MVC\Router;

    class ClientesController {
        public static function index (Router $router) {
            $router->render('admin/index', [
                'pagina' => 'Clientes',
                'headers' => ['Sel', 'Nombre', 'RFC', 'Dir. Fiscal', 'CP', 'Uso de CFDI', 'Correo']
            ]);
        } 
    }
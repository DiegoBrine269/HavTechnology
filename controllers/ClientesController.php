<?php
    namespace Controllers;
    use MVC\Router;
    use Models\Cliente;

    class ClientesController {
        public static function index (Router $router) {
            $clientes = Cliente::all();
            $router->render('admin/index', [
                'pagina' => 'Clientes',
                'headers' => Cliente::getColumnasDB(),
                'modalTitulo' => 'Registrar un nuevo cliente',
                'datos' => $clientes
            ]);
        } 
    }
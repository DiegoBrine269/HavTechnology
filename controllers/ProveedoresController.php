<?php
    namespace Controllers;
    use MVC\Router;
    use Models\Proveedor;

    class ProveedoresController {
        public static function index (Router $router) {
            $proveedores = Proveedor::all();

            //debug($productos);

            $router->render('admin/index', [
                'pagina' => 'Proveedores',
                'headers' => Proveedor::getColumnasDB(),
                'modalTitulo' => 'Registrar un nuevo proveedor',
                'datos' => $proveedores
            ]);
        } 
    }
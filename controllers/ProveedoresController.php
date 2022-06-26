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

        public static function crear (Router $router) {
            $proveedor = new Proveedor();

            $router->render('proveedores/crear', [
                'pagina' => 'Registrar un nuevo proveedor'
            ]);
        }

    }
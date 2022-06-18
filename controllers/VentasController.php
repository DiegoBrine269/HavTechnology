<?php
    namespace Controllers;
    use MVC\Router;

    class VentasController {
        public static function index (Router $router) {
            $router->render('admin/index', [
                'pagina' => 'Ventas',
<<<<<<< HEAD
                'headers' => ['Sel', 'Nombre', 'RFC', 'Dir. Fiscal', 'CP', 'Uso de CFDI', 'Correo']
=======
                'headers' => ['Sel', 'Fecha', 'Cliente', 'Subtotal', 'Total']
>>>>>>> 5318301ca3f94d3cf9c912ad91afc52bcbe114d5
            ]);
        } 
    }
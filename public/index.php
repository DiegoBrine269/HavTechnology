<?php
    require_once __DIR__ . '/../includes/app.php';

    use MVC\Router;
    use Controllers\ClientesController;
    use Controllers\DevolucionesController;
    use Controllers\InicioController;
    use Controllers\ProductosController;
    use Controllers\VentasController;

    $router = new Router();

    $router->get('/inicio', [InicioController::class, 'index']);
    
    $router->get('/login', [InicioController::class, 'login']);
    $router->post('/login', [InicioController::class, 'login']);
   
    $router->get('/productos', [ProductosController::class, 'index']);
    $router->get('/clientes', [ClientesController::class, 'index']);
    $router->get('/ventas', [VentasController::class, 'index']);
    $router->get('/devoluciones', [DevolucionesController::class, 'index']);
    $router->comprobarRutas();
<?php
    require_once __DIR__ . '/../includes/app.php';

    use MVC\Router;
    use Controllers\ProveedoresController;
    use Controllers\ClientesController;
    use Controllers\InicioController;
    use Controllers\ProductosController;
    use Controllers\VentasController;
    use Controllers\DevolucionesController;

    $router = new Router();

    $router->get('/inicio', [InicioController::class, 'index']);
    
    $router->get('/login', [InicioController::class, 'login']);
    $router->post('/login', [InicioController::class, 'login']);
   
    $router->get('/productos', [ProductosController::class, 'index']);
    $router->get('/productos/crear', [ProductosController::class, 'crear']);
    $router->post('/productos/crear', [ProductosController::class, 'crear']);

    $router->get('/proveedores', [ProveedoresController::class, 'index']);
    $router->get('/proveedores/crear', [ProveedoresController::class, 'crear']);
    $router->post('/proveedores/crear', [ProveedoresController::class, 'crear']);

    $router->get('/clientes', [ClientesController::class, 'index']);
    $router->get('/clientes/crear', [ClientesController::class, 'crear']);
    $router->post('/clientes/crear', [ClientesController::class, 'crear']);

    $router->get('/ventas', [VentasController::class, 'index']);
    $router->get('/ventas/crear', [VentasController::class, 'crear']);
    $router->post('/ventas/crear', [VentasController::class, 'crear']);

    $router->get('/devoluciones', [DevolucionesController::class, 'index']);
    
    $router->comprobarRutas();
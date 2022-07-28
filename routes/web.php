<?php

use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProvidersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Rutas para productos
Route::get('/productos', 'App\Http\Controllers\ProductsController@index');
Route::get('/productos/consultar', 'App\Http\Controllers\ProductsController@consultar');
Route::get('/productos/barcode', 'App\Http\Controllers\ProductsController@barcode');
Route::get('/producto-unico/consultar', 'App\Http\Controllers\ProductsController@consultarUnico');

//Rutas para proveedores
Route::get('/proveedores', 'App\Http\Controllers\ProvidersController@index');
Route::get('/proveedores/consultar', 'App\Http\Controllers\ProvidersController@consultar');

//Rutas para clientes
Route::get('/clientes', 'App\Http\Controllers\CustomersController@index');
Route::get('/clientes/consultar', 'App\Http\Controllers\CustomersController@consultar');

//Rutas para ventas
Route::get('/ventas', 'App\Http\Controllers\SalesController@index');
Route::get('/ventas/consultar', 'App\Http\Controllers\SalesController@consultar');
Route::get('/consultar-precio', 'App\Http\Controllers\SalesController@consultarPrecio');
Route::get('/ventas/actualizar', 'App\Http\Controllers\SalesController@actualizar');
Route::post('/ventas/actualizar', 'App\Http\Controllers\SalesController@actualizar');
Route::get('/ventas/reporte', 'App\Http\Controllers\SalesController@reporte');

//Rutas para devoluciones
Route::get('/devoluciones', 'App\Http\Controllers\RefundsController@index');
Route::get('/devoluciones/consultar', 'App\Http\Controllers\RefundsController@consultar');

//Rutas para presupuestos
Route::get('/presupuestos', 'App\Http\Controllers\EstimatesController@index');
Route::get('/presupuestos/consultar', 'App\Http\Controllers\EstimatesController@consultar');

Auth::routes();

Route::get('/inicio', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Rutas permitidas solo para admin
//Productos
Route::post('/productos/registrar', 'App\Http\Controllers\ProductsController@registrar')->middleware('is_admin');
Route::get('/productos/registrar', 'App\Http\Controllers\ProductsController@registrar')->middleware('is_admin');
Route::get('/productos/registrar-entrada', 'App\Http\Controllers\ProductsController@registrarEntrada')->middleware('is_admin');
Route::post('/productos/registrar-entrada', 'App\Http\Controllers\ProductsController@registrarEntrada')->middleware('is_admin');
Route::get('/productos/actualizar', 'App\Http\Controllers\ProductsController@actualizar')->middleware('is_admin');
Route::post('/productos/actualizar', 'App\Http\Controllers\ProductsController@actualizar')->middleware('is_admin');
Route::get('/productos/eliminar', 'App\Http\Controllers\ProductsController@eliminar')->middleware('is_admin');
Route::get('/productos/catalogo', 'App\Http\Controllers\ProductsController@catalogo')->middleware('is_admin');
Route::get('/producto-unico/eliminar', 'App\Http\Controllers\ProductsController@productoUnicoEliminar')->middleware('is_admin');


//Proveedores
Route::get('/proveedores/registrar', 'App\Http\Controllers\ProvidersController@registrar')->middleware('is_admin');
Route::post('/proveedores/registrar', 'App\Http\Controllers\ProvidersController@registrar')->middleware('is_admin');
Route::get('/proveedores/actualizar', 'App\Http\Controllers\ProvidersController@actualizar')->middleware('is_admin');
Route::post('/proveedores/actualizar', 'App\Http\Controllers\ProvidersController@actualizar')->middleware('is_admin');
Route::get('/proveedores/eliminar', 'App\Http\Controllers\ProvidersController@eliminar')->middleware('is_admin');

//Clientes
Route::get('/clientes/registrar', 'App\Http\Controllers\CustomersController@registrar')->middleware('is_admin');
Route::post('/clientes/registrar', 'App\Http\Controllers\CustomersController@registrar')->middleware('is_admin');
Route::get('/clientes/actualizar', 'App\Http\Controllers\CustomersController@actualizar')->middleware('is_admin');
Route::post('/clientes/actualizar', 'App\Http\Controllers\CustomersController@actualizar')->middleware('is_admin');
Route::get('/clientes/eliminar', 'App\Http\Controllers\CustomersController@eliminar')->middleware('is_admin');

//Ventas
Route::post('/ventas/registrar', 'App\Http\Controllers\SalesController@registrar')->middleware('is_admin');
Route::get('/ventas/registrar', 'App\Http\Controllers\SalesController@registrar')->middleware('is_admin');
Route::get('/ventas/eliminar', 'App\Http\Controllers\SalesController@eliminar')->middleware('is_admin');

//Devoluciones
Route::get('/devoluciones/registrar', 'App\Http\Controllers\RefundsController@registrar')->middleware('is_admin');
Route::post('/devoluciones/registrar', 'App\Http\Controllers\RefundsController@registrar')->middleware('is_admin');
Route::get('/devoluciones/actualizar', 'App\Http\Controllers\RefundsController@actualizar')->middleware('is_admin');
Route::post('/devoluciones/actualizar', 'App\Http\Controllers\RefundsController@actualizar')->middleware('is_admin');
Route::get('/devoluciones/eliminar', 'App\Http\Controllers\RefundsController@eliminar')->middleware('is_admin');


//Presupuestos
Route::get('/presupuestos/registrar', 'App\Http\Controllers\EstimatesController@registrar')->middleware('is_admin');
Route::post('/presupuestos/registrar', 'App\Http\Controllers\EstimatesController@registrar')->middleware('is_admin');
Route::get('/presupuestos/actualizar', 'App\Http\Controllers\EstimatesController@actualizar')->middleware('is_admin');
Route::post('/presupuestos/actualizar', 'App\Http\Controllers\EstimatesController@actualizar')->middleware('is_admin');
Route::get('/presupuestos/eliminar', 'App\Http\Controllers\EstimatesController@eliminar')->middleware('is_admin');



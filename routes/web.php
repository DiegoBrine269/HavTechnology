<?php

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
Route::get('/productos/registrar', 'App\Http\Controllers\ProductsController@registrar');
Route::post('/productos/registrar', 'App\Http\Controllers\ProductsController@registrar');
Route::get('/productos/registrar-entrada', 'App\Http\Controllers\ProductsController@registrarEntrada');
Route::post('/productos/registrar-entrada', 'App\Http\Controllers\ProductsController@registrarEntrada');
Route::get('/productos/consultar', 'App\Http\Controllers\ProductsController@consultar');
Route::get('/productos/actualizar', 'App\Http\Controllers\ProductsController@consultar');
Route::post('/productos/actualizar', 'App\Http\Controllers\ProductsController@consultar');
Route::get('/productos/eliminar', 'App\Http\Controllers\ProductsController@eliminar');
Route::get('/producto-unico/eliminar', 'App\Http\Controllers\ProductsController@productoUnicoEliminar');
Route::get('/productos/barcode', 'App\Http\Controllers\ProductsController@barcode');

//Rutas para proveedores
Route::get('/proveedores', 'App\Http\Controllers\ProvidersController@index');
Route::get('/proveedores/registrar', 'App\Http\Controllers\ProvidersController@registrar');
Route::post('/proveedores/registrar', 'App\Http\Controllers\ProvidersController@registrar');
Route::get('/proveedores/consultar', 'App\Http\Controllers\ProvidersController@consultar');
Route::get('/proveedores/actualizar', 'App\Http\Controllers\ProvidersController@consultar');
Route::post('/proveedores/actualizar', 'App\Http\Controllers\ProvidersController@consultar');
Route::get('/proveedores/eliminar', 'App\Http\Controllers\ProvidersController@eliminar');

//Rutas para clientes
Route::get('/clientes', 'App\Http\Controllers\CustomersController@index');
Route::get('/clientes/registrar', 'App\Http\Controllers\CustomersController@registrar');
Route::post('/clientes/registrar', 'App\Http\Controllers\CustomersController@registrar');
Route::get('/clientes/consultar', 'App\Http\Controllers\CustomersController@consultar');
Route::get('/clientes/actualizar', 'App\Http\Controllers\CustomersController@consultar');
Route::post('/clientes/actualizar', 'App\Http\Controllers\CustomersController@consultar');
Route::get('/clientes/eliminar', 'App\Http\Controllers\CustomersController@eliminar');

//Rutas para ventas
Route::get('/ventas', 'App\Http\Controllers\SalesController@index');
Route::get('/ventas/registrar', 'App\Http\Controllers\SalesController@registrar');
Route::post('/ventas/registrar', 'App\Http\Controllers\SalesController@registrar');
Route::get('/ventas/consultar', 'App\Http\Controllers\SalesController@consultar');
Route::get('/ventas/actualizar', 'App\Http\Controllers\SalesController@consultar');
Route::post('/ventas/actualizar', 'App\Http\Controllers\SalesController@consultar');
Route::get('/ventas/eliminar', 'App\Http\Controllers\SalesController@eliminar');
Route::get('/consultar-precio', 'App\Http\Controllers\SalesController@consultarPrecio');
Route::get('/ventas/reporte', 'App\Http\Controllers\SalesController@reporte');

//Rutas para devoluciones
Route::get('/devoluciones', 'App\Http\Controllers\RefundsController@index');
Route::get('/devoluciones/registrar', 'App\Http\Controllers\RefundsController@registrar');
Route::post('/devoluciones/registrar', 'App\Http\Controllers\RefundsController@registrar');
Route::get('/devoluciones/consultar', 'App\Http\Controllers\RefundsController@consultar');
Route::get('/devoluciones/actualizar', 'App\Http\Controllers\RefundsController@consultar');
Route::post('/devoluciones/actualizar', 'App\Http\Controllers\RefundsController@consultar');
Route::get('/devoluciones/eliminar', 'App\Http\Controllers\RefundsController@eliminar');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

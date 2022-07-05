<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\UniqueProduct;
use App\Models\Provider;
use Illuminate\Http\Request;

use function GuzzleHttp\Promise\all;

class ProductsController extends Controller
{
    private function volverAInicio($resultado = ''){
        $resultado = '?resultado=' . $resultado;
        return redirect('/productos' . $resultado );
    }

    public function index (Request $request) {
        $productos = Product::orderBy('id')->get();
        $resultado = $request->resultado;

        return view('productos/index', [
            'titulo' => 'productos',
            'datos' => $productos,
            'resultado' => $resultado
        ]);
    }

    public function registrar (Request $request) {
        $proveedores = Provider::all();

        // Envío de formulario
        if($request->isMethod('post')){

            $nuevoProducto = new Product();

            $nuevoProducto->id = $request->producto['id'];
            $nuevoProducto->nombre = $request->producto['nombre'];
            $nuevoProducto->descripcion = $request->producto['descripcion'];
            $nuevoProducto->color = $request->producto['color'];
            $nuevoProducto->precioVenta = $request->producto['precioventa'];
            $nuevoProducto->stock = $request->producto['stock'];
            
            $nuevoProducto->save();

            for ($i=1; $i <= $nuevoProducto->stock; $i++) { 
                $nuevoProductoUnico = new UniqueProduct();
                $nuevoProductoUnico->id = $request->producto['id'];

                $idNumeros = $this->quitarPrefijoId($i);

                $nuevoProductoUnico->idUnico = $request->producto['id'] . $idNumeros;
                $nuevoProductoUnico->existe = '1';
                $nuevoProductoUnico->lote = $request->producto['lote'];
                $nuevoProductoUnico->idProveedor = $request->producto['idProveedor'];

                $nuevoProductoUnico->save();
            }  

            return $this->volverAInicio('1');
        }

        return view('productos/registrar', [
            'proveedores' => $proveedores,
            'titulo' => 'Registrar nuevo producto'
        ]);
    }

    private function quitarPrefijoId($i) {
        $idNumeros = '00000';
        switch (strlen((string)$i)) {
            case '1':
                $idNumeros = '0000' . $i;
                break;
            case '2':
                $idNumeros = '000' . $i;
                break;
            case '3':
                $idNumeros = '00' . $i;
                break;
            case '4':
                $idNumeros = '0' . $i;
                break;
            
            case '5':
                $idNumeros = $i;
                break;
                
            default:
                $idNumeros = '00000';
                break;
        }

        return $idNumeros;
    }

    //Incrementa el stock de un producto ya existente
    public function registrarEntrada(Request $request){
        if($request->isMethod('post')){
            
            
            //El producto sí existe
            if (Product::where('id', '=', $request->producto['id'])->exists())  {

                //Obteniendo el ID máximo para partir de ese número a registrar
                $maxID = 0;
                $productos = UniqueProduct::where('id', '=', $request->producto['id'])->get();

                foreach ($productos as $producto) {
                    
                    $idSoloNumeros = substr($producto->idUnico, -5);;

                    if($idSoloNumeros > $maxID) {
                        $maxID = $idSoloNumeros;
                    }
                }

                //Registro los productos entrantes
                for ($i = $maxID + 1; $i <= $maxID + $request->producto['stock']; $i++){
                    $nuevoProductoUnico = new UniqueProduct();
                    $nuevoProductoUnico->id = $request->producto['id'];

                    $idNumeros = $this->quitarPrefijoId($i);

                    $nuevoProductoUnico->idUnico = $request->producto['id'] . $idNumeros;
                    $nuevoProductoUnico->existe = '1';
                    $nuevoProductoUnico->lote = $request->producto['lote'];
                    $nuevoProductoUnico->idProveedor = $request->producto['idProveedor'];

                    $nuevoProductoUnico->save();
                }

                //Incremento las existencias del producto
                $producto = Product::find($request->producto['id']);
                Product::where('id', $request->producto['id'])->update(['stock' => $producto->stock + $request->producto['stock']]);

                return $this->volverAInicio('1');
            }
            //El producto no existe
            else {

                $mensajeError = 'El producto con el ID ' . $request->producto['id'] . ' no ha sido registrado';
                $proveedores = Provider::all();

                return view('productos/registrarEntrada', [
                    'proveedores' => $proveedores,
                    'titulo' => 'Registrar entrada de mercancía',
                    'mensajesError' => [$mensajeError]
                ]);
            }
            

        } else if($request->isMethod('get')) {
            $proveedores = Provider::all();

            return view('productos/registrarEntrada', [
                'proveedores' => $proveedores,
                'titulo' => 'Registrar entrada de mercancía'
            ]);
        }
    }


    //Consulta y actualiza
    public function consultar (Request $request) {
        //Envío de formulario para actualizar producto
        if($request->isMethod('post')){
            $idOriginal = $request->producto['idOriginal'];
            
            
            Product::where('id', $idOriginal)->update([
                'nombre' => $request->producto['nombre'],
                'descripcion' => $request->producto['descripcion'],
                'color' => $request->producto['color'],
                'precioVenta' => $request->producto['precioventa'],
                'stock' => $request->producto['stock']
            ]);

            UniqueProduct::where('id', $idOriginal)->update([
                'id' => $request->producto['idOriginal']
            ]);           

            return $this->volverAInicio('1');
    
        }
        //Petición GET para mostrar el formulario
        else if($request->isMethod('get')) {
            if(!isset($request->id)) {
                return redirect('/productos');;
            }

            $producto = Product::find($request->id);        
            $proveedores = Provider::all();
            $productosUnicos = UniqueProduct::where('unique_products.id', '=', $request->id)->join('providers', 'unique_products.idProveedor', '=', 'providers.id')->select('unique_products.*', 'providers.nombre')->orderBy('idUnico')->get();

            return view('productos/consultar', [
                'producto' => $producto,
                'proveedores' => $proveedores,
                'productosUnicos' => $productosUnicos,
                'titulo' => 'Consultar producto ' . $request->id
            ]);
        }
    }

    public function eliminar (Request $request) {
        if(!isset($request->id)) {
            return redirect('/productos');
        }

        UniqueProduct::where('id','=', $request->id)->delete();
        Product::where('id','=', $request->id)->delete();

        return $this->volverAInicio('3');
    }
}
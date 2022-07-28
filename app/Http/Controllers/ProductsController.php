<?php

namespace App\Http\Controllers;

use PDF;
use Exception;
use Carbon\Carbon;
use App\Models\Refund;
use App\Models\Product;
use App\Models\Provider;
use App\Helpers\AppHelper;
use App\Models\SalesProduct;
use Illuminate\Http\Request;
use App\Models\UniqueProduct;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use function PHPUnit\Framework\isNull;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;


class ProductsController extends Controller {
    public function __construct()
    {
        $this->middleware('auth');
    }

    private function volverAInicio($resultado = ''){
        $resultado = '?resultado=' . $resultado;

        return redirect('/productos' . $resultado . $download);
    }

    public function index (Request $request) {

        $productos = Product::orderBy('id')->get();
        $resultado = $request->resultado;
        // $productosEscasos = Product::where('stock', '<', 'cantidadMinima')->orderBy('id')->toSql();
        $productosEscasos = DB::select( ' select *
                                from
                                products
                            where
                                stock < cantidadMinima
                            order by
                                id asc' );
        
        // dd($productosEscasos);

        return view('productos/index', [
            'titulo' => 'productos',
            'datos' => $productos,
            'resultado' => $resultado,
            'productosEscasos' => $productosEscasos
        ]);
    }

    public function consultarUnico (Request $request) { 

        //Información sobre el producto único (¿existe?, ¿fue vendido?, ¿a quién?, ¿cuándo?)
        try {
            $producto = null;
            $devolucion = null;
            $venta = null;
            if(isset($request->id)){
                $producto = UniqueProduct::where('idUnico', '=', $request->id)->join('products', 'unique_products.id', '=', 'products.id')->get()[0] ?? null;
                $devolucion = Refund::where('idProducto', '=', $request->id)->get()[0] ?? null;
                $venta = SalesProduct::where('idProducto', '=', $request->id)->join('sales', 'sales_products.idVenta', '=', 'sales.id')->join('customers', 'sales.idCliente', '=', 'customers.id')->get()[0] ?? null;
                // dd($devolucion);
            }
            
            return view('productos/consultar-unico', [
                'titulo' => 'Consultar producto único', 
                'producto' => $producto,
                'devolucion' => $devolucion,
                'venta' => $venta
            ]);

        } catch (Exception $exception) {
            // dd($exception);
            return $this->volverAInicio('0');
        }
    } 

    public function registrar (Request $request) {
        try {
            $proveedores = Provider::all();

            // Envío de formulario
            if($request->isMethod('post')){
    
                $nuevoProducto = new Product();
                $nuevoProducto->id = $request->producto['id'];
                $nuevoProducto->nombre = $request->producto['nombre'];
                $nuevoProducto->descripcion = $request->producto['descripcion'];
                $nuevoProducto->color = $request->producto['color'];
                $nuevoProducto->precioVenta = $request->producto['precioventa'];
                $nuevoProducto->costo = $request->producto['costo'];
                $nuevoProducto->stock = $request->producto['stock'];
                
                // Guardar imagen
                $imagen = $request->file('imagen');
                $nombreImagen = $request->producto['id'] . "." . $imagen->guessExtension();
                $ruta = public_path("img/");
                copy($imagen->getRealPath(), $ruta.$nombreImagen);
                
                //Guardar ruta de imagen en la base
                $nuevoProducto->imagen = $nombreImagen;
                
                $nuevoProducto->save();
                
                $srcs = [];
                
                for ($i=1; $i <= $nuevoProducto->stock; $i++) { 
                    $nuevoProductoUnico = new UniqueProduct();
                    $nuevoProductoUnico->id = $request->producto['id'];
                    $idNumeros = $this->quitarPrefijoId($i);
                    $nuevoProductoUnico->idUnico = $request->producto['id'] . $idNumeros;
                    $nuevoProductoUnico->existe = '1';
                    $nuevoProductoUnico->lote = $request->producto['lote'];
                    $nuevoProductoUnico->idProveedor = $request->producto['idProveedor'];
                    $nuevoProductoUnico->fechaIngreso = $request->producto['fechaIngreso'];
                    $nuevoProductoUnico->save();
                    
                    //Creación de código de barras
                    $srcs [] = "http://bwipjs-api.metafloor.com/?bcid=code128&text=" . $nuevoProductoUnico->idUnico . "&includetext";
                }  
    
                return \AppHelper::generarBarcodesPDF($srcs, $request->producto['id']);
    
                return $this->volverAInicio('1', 'true');
            }
    
            return view('productos/registrar', [
                'proveedores' => $proveedores,
                'titulo' => 'Registrar nuevo producto'
            ]);
        } catch (Exception $exception) {
            return $this->volverAInicio('0');
        }

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

    private function quitarSufijoId($id) {
        $id = substr($id, 0, -5);
        return $id;
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

                $srcs = [];

                //Registro los productos entrantes
                for ($i = $maxID + 1; $i <= $maxID + $request->producto['stock']; $i++){
                    $nuevoProductoUnico = new UniqueProduct();
                    $nuevoProductoUnico->id = $request->producto['id'];

                    $idNumeros = $this->quitarPrefijoId($i);

                    $nuevoProductoUnico->idUnico = $request->producto['id'] . $idNumeros;
                    $nuevoProductoUnico->existe = '1';
                    $nuevoProductoUnico->lote = $request->producto['lote'];
                    $nuevoProductoUnico->idProveedor = $request->producto['idProveedor'];
                    $nuevoProductoUnico->fechaIngreso = $request->producto['fechaIngreso'];

                    $srcs [] = "http://bwipjs-api.metafloor.com/?bcid=code128&text=" . $nuevoProductoUnico->idUnico . "&includetext";

                    $nuevoProductoUnico->save();
                }  
    
                
                //Incremento las existencias del producto
                $producto = Product::find($request->producto['id']);
                Product::where('id', $request->producto['id'])->update(['stock' => $producto->stock + $request->producto['stock']]);
                
                return  \AppHelper::generarBarcodesPDF($srcs, $request->producto['id']);
                return $this->volverAInicio('1');
            }
            //El producto no existe
            else {
                return $this->volverAInicio('0');
            }
        } else if($request->isMethod('get')) {
            $proveedores = Provider::all();

            return view('productos/registrarEntrada', [
                'proveedores' => $proveedores,
                'titulo' => 'Registrar entrada de mercancía'
            ]);
        }
    }

    public function consultar (Request $request) {
        try {
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
        } catch (Exception $exception) {
            return $this->volverAInicio('0');
        }
    }

    public function actualizar (Request $request) {
        try {
            //Envío de formulario para actualizar producto
            if($request->isMethod('post')){
                $idOriginal = $request->producto['idOriginal'];
                
                Product::where('id', $idOriginal)->update([
                    'nombre' => $request->producto['nombre'],
                    'descripcion' => $request->producto['descripcion'],
                    'color' => $request->producto['color'],
                    'precioVenta' => $request->producto['precioventa'],
                    'costo' => $request->producto['costo'],
                    'cantidadMinima' => $request->producto['cantidadMinima'],
                ]);
                
                UniqueProduct::where('id', $idOriginal)->update([
                    'id' => $request->producto['idOriginal'],
                    // 'fechaIngreso' => $request->producto['fechaIngreso']
                ]);      

                // Actualizar imagen en caso de ser necesario
                $nuevaImagen = $request->file('nuevaImagen');
                if($nuevaImagen !== null) {
                    // Elimino la imagen del servidor
                    File::delete(public_path($request->imagenOriginal));

                    // Subo una nueva imagen
                    $imagen = $request->file('nuevaImagen');
                    $nombreImagen = $request->producto['idOriginal'] . "." . $imagen->guessExtension();
                    $ruta = public_path("img/");
                    copy($imagen->getRealPath(), $ruta.$nombreImagen);

                    // Actualizo el nombre de la imagen en la BD
                    Product::where('id', $idOriginal)->update([
                        'imagen' => $nombreImagen
                    ]);
                }

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

                return view('productos/actualizar', [
                    'producto' => $producto,
                    'proveedores' => $proveedores,
                    'productosUnicos' => $productosUnicos,
                    'titulo' => 'Actualizar producto ' . $request->id . ' - ' .$producto->nombre
                ]);
            }
        } catch (Exception $exception) {
            return $this->volverAInicio('0');
        }
    }

    public function catalogo () {
        $productos = Product::orderBy('id')->get();

        $fecha = Carbon::now();
        $fecha = $fecha->formatLocalized('%d de %B de %Y');

        $datos = compact('productos', 'fecha');

        $pdf = PDF::loadView('productos.catalogo', $datos);
        return $pdf->stream('HAV Technology - Catálogo de productos.pdf');
    }

    public function productoUnicoEliminar (Request $request) {
        if(!isset($request->id)) {
            return redirect('/productos');
        }

        try {
            //Id general, sin sufijo
            $id = $this->quitarSufijoId($request->id);

            UniqueProduct::where('idUnico','=', $request->id)->delete();

            //Decremento el stock
            $producto = Product::find($id);

            Product::where('id', $id)->update([
                'stock' => $producto->stock - 1
            ]);    
            
            // unlink(public_path("img/").$producto->imagen);
            
            return $this->volverAInicio('3');
        } catch (Exception $exception) {
            return $this->volverAInicio('0');
        }
    }

    public function barcode (Request $request) {
        if(!isset($request->id)) 
            return redirect('/productos');

        return  \AppHelper::generarBarcodesPDF(["http://bwipjs-api.metafloor.com/?bcid=code128&text=" . $request->id . "&includetext"], $request->id);
    }


    public function eliminar (Request $request) {
        
        if(!isset($request->id)) 
            return redirect('/productos');
        
        try {
            $nombreImagen = Product::where('id','=', $request->id)->select('imagen')->get()[0]->imagen;
            
            // dd($nombreImagen);
            UniqueProduct::where('id','=', $request->id)->delete();
            Product::where('id','=', $request->id)->delete();
            
            unlink(public_path("img/") . $nombreImagen);
            
            return $this->volverAInicio('3');
            
        } catch (Exception $exception) {
            return $this->volverAInicio('0');
        }
    }
}
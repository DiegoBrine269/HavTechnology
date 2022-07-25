<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Customer;
use App\Models\Product;
use App\Models\SalesProduct;
use App\Models\UniqueProduct;
use Illuminate\Support\Facades\DB;
use Exception;
use PDF;

class SalesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    private function volverAInicio($resultado = ''){
        $resultado = '?resultado=' . $resultado;
        return redirect('/ventas' . $resultado );
    }

    public function index (Request $request) {
        $ventas = Sale::join('customers', 'sales.idCliente', '=', 'customers.id')->select('sales.id', 'customers.nombre as nombreCliente', 'sales.fecha', 'sales.total',)->orderBy('sales.id')->get();
        $resultado = $request->resultado;

        return view('/ventas/index', [
            'titulo' => 'Ventas',
            'datos' => $ventas,
            'resultado' => $resultado
        ]);
    }

    public function registrar (Request $request) {

        try {
            $clientes = Customer::all();

            // Envío de formulario
            if($request->isMethod('post')){
    
                $nuevaVenta = new Sale();
    
                //IDs únicos que serásn vendidos
                $idProductos = $request->productos;
                $nuevaVenta->idCliente = $request->venta['idCliente'];
                $nuevaVenta->fecha = $request->venta['fecha'];
                $nuevaVenta->total = $request->venta['total'];
    
                //Antes de guardar cualquier cosa, validar que todos los productos estén registrados en existencia  
                foreach ($idProductos as $id) {
                    $registrado = UniqueProduct::where('idUnico', '=', $id)->exists();
                    $enExistencia = UniqueProduct::where('idUnico', '=', $id)->select('existe')->get();
    
                    if (!$registrado || !$enExistencia[0]->existe) {
                        return $this->volverAInicio('0');
                    }
                }
                
                //  Ahora sí, guardamos todo
                //Guarda en tabla de ventas
                $nuevaVenta->save();    
                // Guarda por cada producto, un registro en sales_products
                foreach ($idProductos as $id) {
                    $nuevaVentaProducto = new SalesProduct();
                    $nuevaVentaProducto->idVenta = $nuevaVenta->id; 
                    $nuevaVentaProducto->idProducto = $id;
                    $nuevaVentaProducto->cantidad = '1';
    
                    $nuevaVentaProducto->save();
                }

                
                //Cambia la existencia de cada producto único
                foreach ($idProductos as $id) {
                    UniqueProduct::where('idUnico', $id)->update([
                        'existe' => '0'
                    ]);

                    //ID sin sufijo del producto
                    $id = $this->quitarSufijoId($id);
                    $producto = Product::find($id);

                    //Decremento el stock
                    Product::where('id', $id)->update([
                        'stock' => $producto->stock - 1
                    ]);     
                    // dd($producto);   
                    
                }
    
                return $this->volverAInicio('1');
            }
            else if($request->isMethod('get')){
                return view('ventas/registrar', [
                    'clientes' => $clientes,
                    'titulo' => 'Registrar nueva venta'
                ]);
            }
        } catch (Exception $exception) {
            return $this->volverAInicio('0');
        }

    }

    public function consultar (Request $request) {
        try {
            //Envío de formulario para actualizar producto
            if($request->isMethod('post')){
                $idOriginal = $request->venta['idOriginal'];
                
                Sale::where('id', $idOriginal)->update([
                    'idCliente' => $request->venta['idCliente'],
                    'fecha' => $request->venta['fecha'],
                    'total' => $request->venta['total']
                ]);         

                return $this->volverAInicio('1');
            }
            //Petición GET para mostrar el formulario
            else if($request->isMethod('get')) {
                if(!isset($request->id)) {
                    return redirect('/ventas');;
                }

                $venta = Sale::where('sales.id', '=', $request->id)
                            ->join('customers', 'sales.idCliente', '=', 'customers.id')
                            ->select('sales.id', 'customers.id as idCliente', 'customers.nombre as nombreCliente', 'sales.fecha', 'sales.total')->get();        
                
                $productosUnicos = UniqueProduct::join('sales_products', 'unique_products.idUnico', '=', 'sales_products.idProducto')->join('products', 'unique_products.id', '=', 'products.id')->where('sales_products.idVenta', $request->id)->select('unique_products.idUnico', 'products.precioVenta')->orderBy('idUnico')->get();

                $clientes = Customer::all();

                return view('ventas/consultar', [
                    'venta' => $venta[0],
                    'productosUnicos' => $productosUnicos,
                    'clientes' => $clientes,
                    'titulo' => 'Consultar venta ' . $request->id
                ]);
            }
        } catch (Exception $exception) {
            return $this->volverAInicio('0');
        }
    }


    public function reporte (Request $request) {
        if(!isset($request->tipo)) 
            return redirect('/ventas');
        
        $tipo = $request->tipo;
        $ventas = [];
        $total = '0';
        $nombreDocumento = '';
        $fecha = date('d/M/Y');
        $fechaInicial = '';
        $fechaFinal = '';
        // dd($fecha);


        switch ($tipo) {
            case 'anual':
                $ventas = DB::select( 'select
                        sales.id,
                        customers.nombre as nombreCliente,
                        sales.fecha,
                        sales.total
                    from
                        sales
                        inner join customers on sales.idCliente = customers.id
                    where
                        YEAR(fecha)=YEAR(NOW())
                    order by
                        sales.id asc' );

                $total = DB::select( 'select
                        sum(sales.total) as total
                    from
                        sales
                        inner join customers on sales.idCliente = customers.id
                    where
                        YEAR(fecha)=YEAR(NOW())
                    order by
                        sales.id asc' )[0]->total;

                $nombreDocumento = "ventas_{$tipo}_{$fecha}.pdf";
                break;

            case 'mensual':
                $ventas = DB::select( 'select
                        sales.id,
                        customers.nombre as nombreCliente,
                        sales.fecha,
                        sales.total
                    from
                        sales
                        inner join customers on sales.idCliente = customers.id
                    where
                        month(fecha) = month(current_date())
                        and year(fecha) = year(fecha)
                    order by
                        sales.id asc' );

                $total = DB::select( 'select
                        sum(sales.total) as total
                    from
                        sales
                        inner join customers on sales.idCliente = customers.id
                    where
                        month(fecha) = month(current_date())
                        and year(fecha) = year(fecha)
                    order by
                        sales.id asc' )[0]->total;

                $nombreDocumento = "ventas_{$tipo}_{$fecha}.pdf";
                break;
                        
            case 'semanal':
                $ventas = DB::select( 'select
                        sales.id,
                        customers.nombre as nombreCliente,
                        sales.fecha,
                        sales.total
                    from
                        sales
                        inner join customers on sales.idCliente = customers.id
                    where
                        YEARWEEK(fecha)=YEARWEEK(NOW())
                    order by
                        sales.id asc' );

                $total = DB::select( 'select
                        sum(sales.total) as total
                    from
                        sales
                        inner join customers on sales.idCliente = customers.id
                    where
                        YEARWEEK(fecha)=YEARWEEK(NOW())
                    order by
                        sales.id asc' )[0]->total;
                $nombreDocumento = "ventas_{$tipo}_{$fecha}.pdf";
                break;

                case 'diario':
                    $ventas = DB::select( 'select
                            sales.id,
                            customers.nombre as nombreCliente,
                            sales.fecha,
                            sales.total
                        from
                            sales
                            inner join customers on sales.idCliente = customers.id
                        where
                            DATE(fecha) = CURDATE()
                        order by
                            sales.id asc' );
    
                    $total = DB::select( 'select
                            sum(sales.total) as total
                        from
                            sales
                            inner join customers on sales.idCliente = customers.id
                        where
                            DATE(fecha) = CURDATE()
                        order by
                            sales.id asc' )[0]->total;
                    $nombreDocumento = "ventas_{$tipo}_{$fecha}.pdf";
                    break;

                case 'rango':
                    // dd($request->fechaInicial);
                    $fechaInicial = $request->fechaInicial;
                    $fechaFinal = $request->fechaFinal;

                    $ventas = DB::select( "select
                            sales.id,
                            customers.nombre as nombreCliente,
                            sales.fecha,
                            sales.total
                        from
                            sales
                            inner join customers on sales.idCliente = customers.id
                        where
                            fecha between '{$fechaInicial}' and '{$fechaFinal}'
                        order by
                            sales.id asc");
    
                    $total = DB::select( "select
                            sum(sales.total) as total
                        from
                            sales
                            inner join customers on sales.idCliente = customers.id
                        where
                            fecha between '{$fechaInicial}' and '{$fechaFinal}'
                        order by
                            sales.id asc" )[0]->total;

                    $nombreDocumento = "ventas_" . date('d/m/Y', strtotime($request->fechaInicial)) . "_" . date('d/m/Y', strtotime($request->fechaFinal)) . ".pdf";                            
                    break;
                
            default:
                return $this->volverAInicio('0');
                break;
        }

        
        if($ventas === [])
            return $this->volverAInicio('0');

        $datos = compact('ventas', 'total', 'fecha', 'tipo', 'fechaInicial', 'fechaFinal');

        $pdf = PDF::loadView('ventas.reporte', $datos);
        return $pdf->stream($nombreDocumento);
    }

    private function quitarSufijoId($id) {
        $id = substr($id, 0, -5);
        return $id;
    }

    public function eliminar (Request $request) {
        if(!isset($request->id)) {
            return redirect('/ventas');
        }

        try {
            SalesProduct::where('idVenta','=', $request->id)->delete();
            Sale::where('id','=', $request->id)->delete();
        } catch (Exception $exception) {
            return $this->volverAInicio('0');
        }

        return $this->volverAInicio('3');
    }

    public function consultarPrecio (Request $request) {
        if(!isset($request->id)) {
            echo '0';
            return;
        }

        $producto = Product::where('id', $request->id)->select('precioVenta')->get(); 
        echo $producto[0]->precioVenta;
    }
}

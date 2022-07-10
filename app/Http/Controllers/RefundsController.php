<?php

namespace App\Http\Controllers;

use App\Models\UniqueProduct;
use App\Models\Product;
use App\Models\Refund;
use Illuminate\Http\Request;
use Exception;

class RefundsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    private function volverAInicio($resultado = ''){
        $resultado = '?resultado=' . $resultado;
        return redirect('/devoluciones' . $resultado );
    }

    public function index (Request $request) {
        $devoluciones = Refund::all();
        $resultado = $request->resultado;

        // dd($devoluciones);

        return view('/devoluciones/index', [
            'titulo' => 'Devoluciones',
            'datos' => $devoluciones,
            'resultado' => $resultado
        ]);
    }

    public function registrar (Request $request) {

        try {
            if($request->isMethod('post')) { 
                $nuevaDevolucion = new Refund();
                $nuevaDevolucion->idProducto = $request->devolucion['idProducto'];
                $nuevaDevolucion->perdidaTotal = $request->devolucion['perdidaTotal'];
                $nuevaDevolucion->fecha = $request->devolucion['fecha'];
    
                //Si el producto existe, quiere decir que no se ha vendido, po loo que no se puede registrar una devolución
                $enExistencia = UniqueProduct::where('idUnico', '=', $request->devolucion['idProducto'])->select('existe')->get()[0]->existe;
                
                //Si el producto ya ha sido devuelto, no puede ser devuelto nuevamente
                $devuelto = Refund::where('idProducto', '=', $request->devolucion['idProducto'])->exists();
    
                if($enExistencia == '1' || $devuelto == '1')
                    return $this->volverAInicio('0');
    
                // Si no es pérdida total, se incrementa en el stock y se marca como existente
                $perdido = $request->devolucion['perdidaTotal'];
                if($perdido == '0') {
                    UniqueProduct::where('idUnico', $request->devolucion['idProducto'])->update([
                        'existe' => '1'
                    ]);   
    
                    $id = $this->quitarSufijoId($request->devolucion['idProducto']);
    
                    $producto = Product::find($id);
                    Product::where('id', $id)->update(['stock' => $producto->stock + 1]);
                } 
    
    
                
                $nuevaDevolucion->save();
    
                return $this->volverAInicio('1');
    
            } else if($request->isMethod('get')) {
                return view('devoluciones/registrar', [
                    'titulo' => 'Registrar nueva devolución'
                ]);
            }
        } catch (Exception $exception) {
            return $this->volverAInicio('0');
        }
        
    }

    private function quitarSufijoId($id) {
        $id = substr($id, 0, -5);
        return $id;
    }

    public function consultar (Request $request) {

        try {
            //Envío de formulario para actualizar producto
            if($request->isMethod('post')){
                Refund::where('id', $request->devolucion['id'])->update([
                    'fecha' => $request->devolucion['fecha'],
                    'perdidaTotal' => $request->devolucion['perdidaTotal']
                ]);      
                
                return $this->volverAInicio('2');
            }
            //Petición GET para mostrar el formulario
            else if($request->isMethod('get')) {
                if(!isset($request->id)) {
                    return redirect('/devoluciones');;
                }
                
                $devolucion = Refund::find($request->id);        

                return view('devoluciones/consultar', [
                    'devolucion' => $devolucion,
                    'titulo' => 'Consultar devolución ' . $request->id
                ]);
            }
        } catch (Exception $exception) {
            return $this->volverAInicio('0');
        }

    }

    public function eliminar (Request $request) {
        if(!isset($request->id)) {
            return redirect('/devoluciones');
        }

        try {
            Refund::where('id','=', $request->id)->delete();
        } catch (Exception $exception) {
            return $this->volverAInicio('0');
        }
        
        return $this->volverAInicio('3');
    }
}
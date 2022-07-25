<?php

namespace App\Http\Controllers;

use PDF;
use DateTime;
use App\Models\Estimate;
use App\Models\EstimateProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EstimatesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    private function volverAInicio($resultado = ''){
        $resultado = '?resultado=' . $resultado;
        return redirect('/presupuestos' . $resultado );
    }

    public function index (Request $request) {
        $presupuestos = Estimate::all();
        $resultado = $request->resultado;

        return view('/presupuestos/index', [
            'titulo' => 'Presupuestos',
            'datos' => $presupuestos,
            'resultado' => $resultado
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
        
    public function registrar (Request $request) {
        try {

            if($request->isMethod('post')) { 
                return $this->guardarPresupuesto($request);
    
            } else if($request->isMethod('get')) {
                return view('presupuestos/registrar', [
                    'titulo' => 'Crear un nuevo presupuesto'
                ]);
            }
        } catch (Exception $exception) {
            return $this->volverAInicio('0');
        }
    }

    //Esta función la utilizo a la hora de registrar y a la hora de actualizar
    private function guardarPresupuesto(Request $request, $operacion = '') {
        setlocale(LC_ALL,"es_ES");
        Carbon::setLocale('es');

        $nuevoPresupuesto = new Estimate();

        //Generar id (folio) formato: PRE[AÑOENCURSO][ID]
        // Ej: PRE202200045
        $ulitmoNumero = Estimate::orderBy('id', 'desc')->first();
        
        if(is_null($ulitmoNumero)) {
            $ulitmoNumero = "00001";
        }
        else {
            $ulitmoNumero = $this->quitarPrefijoId((int)substr($ulitmoNumero->id, 7) + 1);
        }
        
        //Si es update, mantenemos el mismo ID
        if($operacion === 'update') 
            $nuevoPresupuesto->id = $request->id;
        else
            $nuevoPresupuesto->id = "PRE" . date("Y") . $ulitmoNumero . ".pdf";

        $nuevoPresupuesto->nombreCliente = $request->presupuesto['nombreCliente'] ?? '';
        $nuevoPresupuesto->correo = $request->presupuesto['correo'] ?? '';
        $nuevoPresupuesto->envio = $request->presupuesto['envio'] ?? '0';
        
        $fecha = Carbon::now();
        $fecha = $fecha->formatLocalized('%d de %B de %Y');
        
        //Creamos y asignamos fecha del último día del mes actual como valor por omisión
        $fecha2 = Carbon::now();
        $fecha2->addMonth();
        $fecha2->day = 0;
        $fecha2 = $fecha2->formatLocalized('%d de %B de %Y');
        
        if(is_null($request->presupuesto['fechaLimite'])) {
            $fechaLimite = $fecha2;
        } else {
            $fechaLimite = Carbon::parse($request->presupuesto['fechaLimite']);
            $fechaLimite = $fechaLimite->formatLocalized('%d de %B de %Y');
            // $nuevoPresupuesto->fechaValidez = $fechaLimite;
        }

        //Reasignamos la fecha en formato adecuado
        if(is_null($request->presupuesto['fechaLimite'])) {
            $nuevoPresupuesto->fechaValidez = date('Y-m-t');
        } else {
            $nuevoPresupuesto->fechaValidez = $request->presupuesto['fechaLimite'];
        }

        $nuevoPresupuesto->save();

        //Iterando todos los productos 
        $productos = [];
        $i = 0;
        foreach ($request->productos as $idProducto) {

            if(is_null(Product::find($idProducto))) {
                return $this->volverAInicio('0');
            }

            $productos [] = Product::find($idProducto);
            
            //Último elemento
            $productos[count($productos)-1]->cantidad = $request->cantidades[$i];
            
            //Guardamos en tabla de estimates_productos (tabla de muchos a muchos)
            $presupuestoProducto = new EstimateProduct();
            $presupuestoProducto->idPresupuesto = $nuevoPresupuesto->id;
            $presupuestoProducto->idProducto = $idProducto;
            $presupuestoProducto->cantidad = $productos[$i]->cantidad;

            $presupuestoProducto->save();
            
            $i++;
        }

        //Obteniendo las cantidades
        $datos = compact('nuevoPresupuesto', 'fecha', 'fechaLimite', 'productos');

        $pdf = PDF::loadView('presupuestos.reporte', $datos);

        //Renderiza el archivo primero
        $pdf->render();

        //Guardalo en una variable
        $output = $pdf->output();


        file_put_contents( public_path("pre/").$nuevoPresupuesto->id, $output);

        if($operacion === 'update') {
            return $this->volverAInicio('2');
        }

        return $pdf->download($nuevoPresupuesto->id);
        return $this->volverAInicio('1');
    }

    //Muestra el pdf en el mismo navegador
    public function consultar (Request $request) {
        try {
            if(!isset($request->id)) {
                return redirect('/presupuestos');
            }

            if(!file_exists(public_path("pre/").$request->id)) {
                return redirect('/presupuestos');
            }

            header("Content-type: application/pdf");
            header("Content-Disposition: inline; filename=documento.pdf");
            readfile(public_path("pre/").$request->id);
        } catch (Exception $exception) {
            return $this->volverAInicio('0');
        }
    }

    //Muestra el formulario que permite actualizar
    public function actualizar (Request $request) {
        try {
            if($request->isMethod('post')) { 
                // dd($request->id);
                EstimateProduct::where('idPresupuesto', '=', $request->id)->delete();
                Estimate::where('id', '=', $request->id)->delete();
                unlink(public_path("pre/").$request->id);

                return $this->guardarPresupuesto($request, 'update');

                return $this->volverAInicio('2');
            }
            else {
                if(!isset($request->id)) {
                    return redirect('/presupuestos');
                }
    
                if(!file_exists(public_path("pre/").$request->id)) {
                    return redirect('/presupuestos');
                }
    
                $presupuesto = Estimate::find($request->id);
                $productos = Estimate::where('estimates.id', '=', $request->id)->join('estimates_products', 'estimates.id', '=', 'estimates_products.idPresupuesto')->select('idProducto', 'cantidad')->get();
    
                return view('presupuestos/actualizar', [
                    'titulo' => 'Crear un nuevo presupuesto',
                    'presupuesto' => $presupuesto,
                    'productos' => $productos,
                    'titulo' => 'Actualizar presupuesto ' . substr($request->id, 0, -4)
                ]);
                
            }
            
        } catch (Exception $exception) {
            return $this->volverAInicio('0');
        }
    }

    public function eliminar (Request $request) {
        try {
            if(!isset($request->id)) {
                return redirect('/presupuestos');
            }

            if(!file_exists(public_path("pre/").$request->id)) {
                return $this->volverAInicio('0');
            }

            EstimateProduct::where('idPresupuesto', '=', $request->id)->delete();
            Estimate::where('id', '=', $request->id)->delete();
            unlink(public_path("pre/").$request->id);
            
            return $this->volverAInicio('3');                 

        } catch (Exception $exception) {
            return $this->volverAInicio('0');
        }
    }
}

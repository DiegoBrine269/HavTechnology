<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\UsoCfdi;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    private function volverAInicio($resultado = ''){
        $resultado = '?resultado=' . $resultado;
        return redirect('/clientes' . $resultado );
    }

    public function index (Request $request) {
        
        //$usosCFDI = UsoCfdi::all();
        $clientes = Customer::join('uso_cfdi', 'customers.usocfdi', '=', 'uso_cfdi.id')->select('customers.id', 'customers.nombre', 'customers.RFC as rfc', 'customers.dirfiscal', 'customers.cp', 'uso_cfdi.descripcion as usocfdi', 'uso_cfdi.id as idusocfdi', 'customers.correo')->get();
        $resultado = $request->resultado;

        // dd($clientes);

        return view('/clientes/index', [
            'titulo' => 'Clientes',
            'datos' => $clientes,
            'resultado' => $resultado
        ]);
    }

    //Consulta y actualiza
    public function consultar (Request $request) {

        //Envío de formulario para actualizar producto
        if($request->isMethod('post')){
            
            Customer::where('id', $request->cliente['id'])->update([
                'nombre' => $request->cliente['nombre'],
                'rfc' => $request->cliente['rfc'],
                'dirfiscal' => $request->cliente['dirfiscal'],
                'cp' => $request->cliente['cp'],
                'usocfdi' => $request->cliente['usocfdi'],
                'correo' => $request->cliente['correo']
            ]);      

            return $this->volverAInicio('2');
        }
        //Petición GET para mostrar el formulario
        else if($request->isMethod('get')) {
            if(!isset($request->id)) {
                return redirect('/clientes');;
            }

            $cliente = Customer::find($request->id);    
            $usosCFDI = UsoCfdi::all();

            // dd($usosCFDI);

            return view('clientes/consultar', [
                'cliente' => $cliente,
                'titulo' => 'Consultar cliente ' . $request->id,
                'usosCFDI' => $usosCFDI
            ]);
        }
    }

    public function registrar (Request $request) {

        if($request->isMethod('post')) { 
            $nuevoCliente = new Customer();

            $nuevoCliente->nombre = $request->cliente['nombre'];
            $nuevoCliente->rfc = $request->cliente['rfc'];
            $nuevoCliente->dirFiscal = $request->cliente['dirfiscal'];
            $nuevoCliente->cp = $request->cliente['cp'];
            $nuevoCliente->usoCFDI = $request->cliente['usocfdi'];
            $nuevoCliente->correo = $request->cliente['correo'];
            
            $nuevoCliente->save();

            return $this->volverAInicio('1');

        } else if($request->isMethod('get')) {

            $usosCFDI = UsoCfdi::all();

            return view('clientes/registrar', [
                'titulo' => 'Registrar nuevo cliente',
                'usosCFDI' => $usosCFDI 
            ]);
        }
    }

    public function eliminar (Request $request) {
        if(!isset($request->id)) {
            return redirect('/clientes');
        }

        Customer::where('id','=', $request->id)->delete();

        return $this->volverAInicio('3');
    }

}

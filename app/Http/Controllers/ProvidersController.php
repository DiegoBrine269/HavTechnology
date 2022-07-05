<?php

namespace App\Http\Controllers;
use App\Models\Provider;

use Illuminate\Http\Request;

class ProvidersController extends Controller {

    private function volverAInicio($resultado = ''){
        $resultado = '?resultado=' . $resultado;
        return redirect('/proveedores' . $resultado );
    }

    public function index (Request $request) {
        $proveedores = Provider::all();

        $resultado = $request->resultado;

        return view('/proveedores/index', [
            'titulo' => 'Proveedores',
            'datos' => $proveedores,
            'resultado' => $resultado
        ]);
    }

    public function registrar (Request $request) {

        if($request->isMethod('post')) { 
            $nuevoProveedor = new Provider();

            $nuevoProveedor->nombre = $request->proveedor['nombre'];
            $nuevoProveedor->telefono = $request->proveedor['telefono'];
            $nuevoProveedor->correo = $request->proveedor['correo'];
            
            $nuevoProveedor->save();

            return $this->volverAInicio('1');

        } else if($request->isMethod('get')) {
            return view('proveedores/registrar', [
                'titulo' => 'Registrar nuevo proveedor'
            ]);
        }
    }

    //Consulta y actualiza
    public function consultar (Request $request) {

        //Envío de formulario para actualizar producto
        if($request->isMethod('post')){
            
            Provider::where('id', $request->proveedor['id'])->update([
                'nombre' => $request->proveedor['nombre'],
                'telefono' => $request->proveedor['telefono'],
                'correo' => $request->proveedor['correo']
            ]);      

            return $this->volverAInicio('2');
        }
        //Petición GET para mostrar el formulario
        else if($request->isMethod('get')) {
            if(!isset($request->id)) {
                return redirect('/proveedores');;
            }

            $proveedor = Provider::find($request->id);        

            return view('proveedores/consultar', [
                'proveedor' => $proveedor,
                'titulo' => 'Consultar proveedor ' . $request->id
            ]);
        }
    }

    
    public function eliminar (Request $request) {
        if(!isset($request->id)) {
            return redirect('/proveedores');
        }

        Provider::where('id','=', $request->id)->delete();

        return $this->volverAInicio('3');
    }
    
}

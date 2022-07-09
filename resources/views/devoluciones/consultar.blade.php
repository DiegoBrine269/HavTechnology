@extends('main')

@section('content')    
    <form action="/devoluciones/actualizar" class="formulario" method="POST">
        @csrf
        <input type="hidden" name="devolucion[id]" value="{{ $devolucion->id }}">
        <div class="campo">
            <label for="idUnico">ID del producto:</label>
            <input required type="text" name="devolucion[idProducto]" id="idUnico" disabled value="{{ $devolucion->idProducto }}" >
        </div>

        <div class="campo">
            <label for="perdidaTotal">Pérdida Total:</label>
            <select required name="devolucion[perdidaTotal]" id="perdidaTotal">
                <option 
                    value="1"
                    @if ($devolucion->perdidaTotal == '1')
                        selected
                    @endif
                > 
                    Sí 
                </option>
                <option 
                    value="0"
                    @if ($devolucion->perdidaTotal == '0')
                        selected
                    @endif
                > 
                    No 
                </option>
            </select>
        </div>

        <div class="campo">
            <label for="correo">Fecha:</label>
            <input required type="date" name="devolucion[fecha]" id="fecha" value="{{ $devolucion->fecha }}">
        </div>

        <div class="campo">
            <input class="boton boton-principal" type="submit" value="Registrar">
        </div>   
    </form>
@stop
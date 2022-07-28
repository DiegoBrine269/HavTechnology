@extends('main')

@section('content')    
    <form action="/devoluciones/actualizar" class="formulario" method="POST">
        @csrf
        <input type="hidden" name="devolucion[id]" value="{{ $devolucion->id }}">
        <div class="campo">
            <label for="idUnico">ID del producto:</label>
            <input readonly required type="text" name="devolucion[idProducto]" id="idUnico" value="{{ $devolucion->idProducto }}" >
        </div>

        <div class="campo">
            <label for="perdidaTotal">Pérdida Total:</label>
            <input readonly type="text" 
                @if ($devolucion->perdidaTotal == '1')
                    value="Sí"
                @else
                    value="No"
                @endif
            >
        </div>

        <div class="campo">
            <label for="correo">Fecha:</label>
            <input readonly type="date" name="devolucion[fecha]" id="fecha" value="{{ $devolucion->fecha }}">
        </div>
    </form>
@stop
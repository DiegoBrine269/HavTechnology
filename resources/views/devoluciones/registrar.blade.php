@extends('main')

@section('content')    
    <form action="/devoluciones/registrar" class="formulario" method="POST">
        @csrf
        <div class="campo">
            <label for="idUnico">ID del producto:</label>
            <input required type="text" name="devolucion[idProducto]" id="idUnico">
        </div>

        <div class="campo">
            <label for="perdidaTotal">Pérdida Total:</label>
            <select required name="devolucion[perdidaTotal]" id="perdidaTotal">
                <option value="1"> Sí </option>
                <option value="0"> No </option>
            </select>
        </div>

        <div class="campo">
            <label for="correo">Fecha:</label>
            <input required type="date" name="devolucion[fecha]" id="fecha">
        </div>

        <div class="campo">
            <input class="boton boton-principal" type="submit" value="Registrar">
        </div>   
    </form>
@stop
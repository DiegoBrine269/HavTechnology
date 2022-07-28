@extends('main')

@section('content')    
    <form action="/ventas/actualizar" class="formulario" method="POST">
        @csrf
        <p class="alinear-derecha is-required"> Campos obligatorios</p>
        <input type="hidden" name="venta[idOriginal]" value="{{ $venta->id }}">
        <div class="campo">
            <label class="is-required" for="cliente">Cliente:</label>
            <select required name="venta[idCliente]" id="cliente">    
                @foreach ($clientes as $cliente) 
                    <option 
                        @if ($cliente->id === $venta->idCliente)
                            {{ 'selected' }}
                        @endif
                        value="{{ $cliente->id }}">
                        {{ $cliente->nombre }}
                    </option>
                @endforeach
            </select>

        </div>

        <div class="campo">
            <label class="is-required" for="venta[fecha]">Fecha:</label>
            <input type="date" name="venta[fecha]" id="fecha" required value="{{ $venta->fecha }}">
        </div>

        <div class="campo">
            <label class="is-required" for="total">Total:</label>
            <input value="{{ $venta->total }}" type="text" required name="venta[total]" id="total">
        </div>
        
        <div class="campo-dos">
            <input class="boton boton-principal" type="submit" value="Actualizar">
            <a href="/ventas" class="boton">Volver atrás</a>
        </div>   
    </form>

    <h3>Productos de la venta</h3>
    <table class="tabla" cellspacing=0>
        <thead>
            <th class="capitalize">ID Único</th>
            <th class="capitalize">Precio de venta</th>
        </thead>
        <tbody>
            @foreach ($productosUnicos as $productoUnico)
                <tr>
                    <td> {{ $productoUnico->idUnico }} </td>
                    <td> $ {{ $productoUnico->precioVenta }} </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop
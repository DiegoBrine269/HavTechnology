@extends('main')

@section('content')    
    <form action="/ventas/actualizar" class="formulario" method="POST">
        @csrf
        <input type="hidden" name="venta[idOriginal]" value="{{ $venta->id }}">
        <div class="campo">

            <label for="cliente">Cliente:</label>
                <input type="text"   
                    @foreach ($clientes as $cliente) 
                        @if ($cliente->id === $venta->idCliente)
                            value="{{ $cliente->nombre }}"
                            {{ $cliente->nombre }}
                        @endif
                    @endforeach
                    readonly required name="venta[idCliente]" id="cliente">  
        </div>

        <div class="campo">
            <label for="venta[fecha]">Fecha:</label>
            <input readonly type="date" name="venta[fecha]" id="fecha" required value="{{ $venta->fecha }}">
        </div>

        <div class="campo">
            <label for="total">Total:</label>
            <input readonly value="{{ $venta->total }}" type="text" required name="venta[total]" id="total">
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
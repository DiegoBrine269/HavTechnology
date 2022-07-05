@extends('main')

@section('content')    
    <form action="/ventas/registrar" class="formulario" method="POST">
        @csrf
        <div class="campo">
            <label for="cliente">Cliente:</label>
            <select required name="venta[idCliente]" id="cliente">    
                {{-- //Despliega en el select todos los clientes que están registrados --}}
                @foreach ($clientes as $cliente) 
                    <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="campo">
            <label for="fecha">Fecha:</label>
            <input type="date" name="venta[fecha]" id="fecha" required>
        </div>

        <div class="campo">
            <label for="total">Artículos vendidos:</label>
            <div class="lista-productos">
                <input required type="text" name="productos[]" class="producto-item" placeholder="ID o SKU">
            </div>
        </div>

        <div class="campo">
            <label for="total">Total:</label>
            <input required type="number" min="1" max="99999" name="venta[total]" id="total">
        </div>

        <div class="campo-cuatro">
            <input class="boton boton-principal" type="submit" value="Registrar">
            <button class="boton" id="add"> Añadir Producto </button>
            <button class="boton" id="remove"> Eliminar Producto </button>
            <button class="boton" id="calcularTotal"> Calcular Total </button>
        </div>   
    </form>

    <script src="/js/venta.js"></script>
@stop
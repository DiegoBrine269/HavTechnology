@extends('main')

@section('content')    
    <form action="/presupuestos/actualizar" class="formulario" method="POST">
        @csrf
        <input type="hidden" name="id" value={{$presupuesto->id}}>
        <div class="campo">
            <label for="idUnico">Cliente:</label>
            <input type="text" name="presupuesto[nombreCliente]" id="idUnico" value="{{ $presupuesto->nombreCliente }}">
        </div>

        <div class="campo">
            <label for="correo">Correo:</label>
            <input type="email" name="presupuesto[correo]" id="correo" value="{{ $presupuesto->correo }}">
        </div>

        <div class="campo">
            <label for="fecha">Fecha límite:</label>
            <input type="date" name="presupuesto[fechaLimite]" id="fecha" value="{{ $presupuesto->fechaValidez }}">
        </div>

        <div class="campo">
            <label for="total">Artículos a cotizar:</label>
            <div class="lista-productos" style="gap: 0;">
                @foreach ($productos as $producto)
                    <div class="campo-dos">
                        <input required type="text" name="productos[]" class="producto-item" placeholder="ID o SKU" value="{{$producto->idProducto}}">
                        <input required type="number" name="cantidades[]" class="producto-item" placeholder="Cantidad" value="{{$producto->cantidad}}">
                    </div>
                @endforeach
            </div>
        </div>

        <div class="campo">
            <label for="envio">Envío incluido:</label>
            <input type="checkbox" name="presupuesto[envio]" 

                @if ($presupuesto->envio === 1)
                    checked
                @endif    
            value="1"
            >
        </div>

        <div class="campo-tres">
            <input class="boton boton-principal" type="submit" value="Actualizar">
            <button class="boton" id="add"> Añadir Producto </button>
            <button class="boton" id="remove"> Eliminar Producto </button>
        </div>  
    </form>

    <script src="/js/presupuesto.js"></script>
    
@stop


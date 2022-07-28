@extends('main')

@section('content')    
    <form action="/presupuestos/registrar" class="formulario" method="POST">
        @csrf
        <p class="alinear-derecha is-required"> Campos obligatorios</p>
        <div class="campo">
            <label for="idUnico">Cliente:</label>
            <input type="text" name="presupuesto[nombreCliente]" id="idUnico">
        </div>

        <div class="campo">
            <label for="correo">Correo:</label>
            <input type="email" name="presupuesto[correo]" id="correo">
        </div>

        <div class="campo">
            <label for="fecha">Fecha límite:</label>
            <input type="date" name="presupuesto[fechaLimite]" id="fecha">
        </div>

        <div class="campo">
            <label class="is-required" for="total">Artículos a cotizar:</label>
            <div class="lista-productos" style="gap: 0;">
                <div class="campo-dos">
                    <input required type="text" name="productos[]" class="producto-item" placeholder="ID o SKU">
                    <input required type="number" name="cantidades[]" class="producto-item" placeholder="Cantidad">
                </div>
            </div>
        </div>

        <div class="campo">
            <label for="envio">Envío incluido:</label>
            <input type="checkbox" name="presupuesto[envio]" value="1">
        </div>

        <div class="campo-tres">
            <input class="boton boton-principal" type="submit" value="Crear">
            <button class="boton" id="add"> Añadir Producto </button>
            <button class="boton" id="remove"> Eliminar Producto </button>
        </div>  
    </form>

    <script src="/js/presupuesto.js"></script>
@stop
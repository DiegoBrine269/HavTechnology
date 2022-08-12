@extends('main')

@section('content')    
    <form action="/proveedores/registrar" class="formulario" method="POST">
        @csrf
        <p class="alinear-derecha is-required"> Campos obligatorios</p>
        <div class="campo">
            <label class="is-required" for="nombre">Nombre:</label>
            <input required type="text" name="proveedor[nombre]" id="nombre" placeholder="Ej. Electrónica Santiago">
        </div>

        <div class="campo">
            <label class="is-required" for="telefono">Teléfono: (hasta 15 dígitos)</label>
            <input required type="tel" name="proveedor[telefono]" id="telefono" placeholder="Ej. 5512345678">
        </div>

        <div class="campo">
            <label class="is-required" for="correo">Correo:</label>
            <input required type="text" name="proveedor[correo]" id="correo" placeholder="alguien@ejemplo.com">
        </div>

        <div class="campo">
            <input class="boton boton-principal" type="submit" value="Registrar">
        </div>   
    </form>
@stop
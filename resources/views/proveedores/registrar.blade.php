@extends('main')

@section('content')    
    <form action="/proveedores/registrar" class="formulario" method="POST">
        @csrf
        <div class="campo">
            <label for="nombre">Nombre:</label>
            <input required type="text" name="proveedor[nombre]" id="nombre">
        </div>

        <div class="campo">
            <label for="telefono">Teléfono:</label>
            <input required type="tel" name="proveedor[telefono]" id="telefono">
        </div>

        <div class="campo">
            <label for="correo">Correo:</label>
            <input required type="text" name="proveedor[correo]" id="correo">
        </div>

        <div class="campo">
            <input class="boton boton-principal" type="submit" value="Registrar">
        </div>   
    </form>
@stop
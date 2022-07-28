@extends('main')

@section('content')    
    <form action="/proveedores/actualizar" class="formulario" method="POST">
        @csrf
        <p class="alinear-derecha is-required"> Campos obligatorios</p>
        <input type="hidden" name="proveedor[id]" value="{{ $proveedor->id }}">
        <div class="campo">
            <label class="is-required" for="nombre">Nombre:</label>
            <input value="{{ $proveedor->nombre }}" required type="text" name="proveedor[nombre]" id="nombre">
        </div>

        <div class="campo">
            <label class="is-required" for="telefono">Teléfono:</label>
            <input value="{{ $proveedor->telefono }}" required type="tel" name="proveedor[telefono]" id="telefono">
        </div>

        <div class="campo">
            <label class="is-required" for="color">Correo</label>
            <input value="{{ $proveedor->correo }}" required type="text" name="proveedor[correo]" id="correo">
        </div>
        
        <div class="campo-dos">
            <input class="boton boton-principal" type="submit" value="Actualizar">
            <a href="/proveedores" class="boton">Volver atrás</a>
        </div>   
    </form>
@stop
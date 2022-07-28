@extends('main')

@section('content')    
    <form action="/proveedores/actualizar" class="formulario" method="POST">
        @csrf
        <input type="hidden" name="proveedor[id]" value="{{ $proveedor->id }}">
        <div class="campo">
            <label for="nombre">Nombre:</label>
            <input readonly value="{{ $proveedor->nombre }}" required type="text" name="proveedor[nombre]" id="nombre">
        </div>

        <div class="campo">
            <label for="telefono">Teléfono:</label>
            <input readonly value="{{ $proveedor->telefono }}" required type="tel" name="proveedor[telefono]" id="telefono">
        </div>

        <div class="campo">
            <label for="color">Correo</label>
            <input readonly value="{{ $proveedor->correo }}" required type="text" name="proveedor[correo]" id="correo">
        </div>
        
    </form>
@stop
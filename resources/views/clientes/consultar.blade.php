@extends('main')

@section('content')    
    <form action="/clientes/actualizar" class="formulario" method="POST">
        @csrf
        <input type="hidden" name="cliente[id]" value="{{ $cliente->id }}">
        <div class="campo">
            <label for="nombre">Nombre:</label>
            <input readonly value="{{ $cliente->nombre }}" required type="text" name="cliente[nombre]" id="nombre">
        </div>

        <div class="campo">
            <label for="rfc">RFC:</label>
            <input readonly value="{{ $cliente->RFC }}" required type="text" name="cliente[rfc]" id="rfc" pattern="[A-ZÑ&]{3,4}\d{6}[A-V1-9][A-Z1-9][0-9A]">
        </div>

        <div class="campo">
            <label for="dirfiscal">Dirección Fiscal:</label>
            <input readonly value="{{ $cliente->dirFiscal }}" required type="text" name="cliente[dirfiscal]" id="dirfiscal">
        </div>

        <div class="campo">
            <label for="cp">C.P:</label>
            <input readonly value="{{ $cliente->CP }}" required type="number" name="cliente[cp]" id="cp">
        </div>

        <div class="campo">
            <label for="cfdi">Uso de CFDI:</label>
            <input readonly 
                value="{{ $usoCFDI->id . " - " . $usoCFDI->descripcion }}" 
                required type="text" name="cliente[usocfdi]" id="cfdi">
        </div>

        <div class="campo">
            <label for="color">Correo</label>
            <input value="{{ $cliente->correo }}" required type="text" name="cliente[correo]" id="correo" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">
        </div>
    </form>
@stop
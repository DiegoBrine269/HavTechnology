@extends('main')

@section('content')    
    <form action="/clientes/actualizar" class="formulario" method="POST">
        @csrf
        <input type="hidden" name="cliente[id]" value="{{ $cliente->id }}">
        <div class="campo">
            <label for="nombre">Nombre:</label>
            <input value="{{ $cliente->nombre }}" required type="text" name="cliente[nombre]" id="nombre">
        </div>

        <div class="campo">
            <label for="rfc">RFC:</label>
            <input value="{{ $cliente->RFC }}" required type="text" name="cliente[rfc]" id="rfc" pattern="[A-ZÑ&]{3,4}\d{6}[A-V1-9][A-Z1-9][0-9A]">
        </div>

        <div class="campo">
            <label for="dirfiscal">Dirección Fiscal:</label>
            <input value="{{ $cliente->dirFiscal }}" required type="text" name="cliente[dirfiscal]" id="dirfiscal">
        </div>

        <div class="campo">
            <label for="cp">C.P:</label>
            <input value="{{ $cliente->CP }}" required type="number" name="cliente[cp]" id="cp">
        </div>

        <div class="campo">
            <label for="cfdi">Uso de CFDI:</label>
            <select required name="cliente[usocfdi]" id="cfdi">    
                {{-- //Despliega en el select todos los CFDIs que están registrados --}}
                @foreach ($usosCFDI as $usoCFDI) 
                    <option 
                        @if ($cliente->usoCFDI === $usoCFDI->id)
                            {{ 'selected' }}
                        @endif
                        value="{{ $usoCFDI->id }}">
                        {{ $usoCFDI->id . ' - ' .$usoCFDI->descripcion }}
                    </option> 
                @endforeach
            </select>
        </div>

        <div class="campo">
            <label for="color">Correo</label>
            <input value="{{ $cliente->correo }}" required type="text" name="cliente[correo]" id="correo" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">
        </div>
        
        <div class="campo-dos">
            <input class="boton boton-principal" type="submit" value="Actualizar">
            <a href="/clientes" class="boton">Volver atrás</a>
        </div>   
    </form>
@stop
@extends('main')

@section('content')    
    <form action="/clientes/registrar" class="formulario" method="POST">
        @csrf
        <div class="campo">
            <label for="nombre">Nombre:</label>
            <input required type="text" name="cliente[nombre]" id="nombre">
        </div>

        <div class="campo">
            <label for="rfc">RFC:</label>
            <input required type="text" name="cliente[rfc]" id="rfc">
        </div>

        <div class="campo">
            <label for="dirfiscal">Dirección Fiscal:</label>
            <input required type="text" name="cliente[dirfiscal]" id="dirFiscal">
        </div>

        <div class="campo">
            <label for="cp">C.P:</label>
            <input required type="number" name="cliente[cp]" id="cp">
        </div>

        <div class="campo">
            <label for="cfdi">Uso de CFDI:</label>
            <select required name="cliente[usocfdi]" id="cfdi">    
                {{-- //Despliega en el select todos los CFDIs que están registrados --}}
                @foreach ($usosCFDI as $usoCFDI) 
                    <option 
                        value="{{ $usoCFDI->id }}">
                        {{ $usoCFDI->id . ' - ' .$usoCFDI->descripcion }}
                    </option> 
                @endforeach
            </select>
        </div>

        <div class="campo">
            <label for="color">Correo</label>
            <input required type="text" name="cliente[correo]" id="correo">
        </div>

        <div class="campo">
            <input class="boton boton-principal" type="submit" value="Registrar">
        </div>   
    </form>
@stop
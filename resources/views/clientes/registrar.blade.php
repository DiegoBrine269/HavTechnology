@extends('main')

@section('content')    
    <div id="resultado" class="mensaje mensaje-error invisible"></div>
    <form id="form_registrar" action="/clientes/registrar" class="formulario" method="POST">
        @csrf
        <p class="alinear-derecha is-required"> Campos obligatorios</p>
        <div class="campo">
            <label class="is-required" for="nombre">Nombre:</label>
            <input required type="text" name="cliente[nombre]" id="nombre">
        </div>

        <div class="campo">
            <label class="is-required" for="rfc">RFC:</label>
            <input required type="text" name="cliente[rfc]" id="rfc_input" pattern="[A-ZÑ&]{3,4}\d{6}[A-V1-9][A-Z1-9][0-9A]">
        </div>

        <div class="campo">
            <label class="is-required" for="dirfiscal">Dirección Fiscal:</label>
            <input required type="text" name="cliente[dirfiscal]" id="dirFiscal">
        </div>

        <div class="campo">
            <label class="is-required" for="cp">C.P:</label>
            <input required type="number" name="cliente[cp]" id="cp" maxlength="5">
        </div>

        <div class="campo">
            <label class="is-required" for="cfdi">Uso de CFDI:</label>
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
            <label class="is-required" for="color">Correo</label>
            <input required type="email" name="cliente[correo]" id="correo" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">
        </div>

        <div class="campo-uno">
            <input class="boton boton-principal" type="submit" value="Registrar">
        </div>   
    </form>

    <script src="/js/cliente.js"></script>
@stop
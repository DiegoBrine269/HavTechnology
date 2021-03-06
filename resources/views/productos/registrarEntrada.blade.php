@extends('main')

@section('content')    
    <form action="/productos/registrar-entrada" class="formulario" method="POST">
        @csrf
        <div class="campo">
            <label for="id">ID (SKU):</label>
            <input required type="text" value="" name="producto[id]" id="id">
        </div>

        <div class="campo">
            <label for="lote">Lote:</label>
            <input required type="number" min="1" max="99999" value="" name="producto[lote]" id="lote">
        </div>

        <div class="campo">
            <label for="stock">Cantidad que ingresa:</label>
            <input required type="number" min="1" max="99999" value="" name="producto[stock]" id="cantidad">
        </div>
        
        <div class="campo">
            <label for="proveedor">Proveedor:</label>
            <select required name="producto[idProveedor]" id="proveedor">    
                {{-- //Despliega en el select todos los proveedores que están registrados --}}
                @foreach ($proveedores as $proveedor) 
                    <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="campo">
            <input class="boton boton-principal" type="submit" value="Registrar">
        </div>   
    </form>
@stop
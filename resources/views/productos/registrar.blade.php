@extends('main')

@section('content')    
    <form action="/productos/registrar" class="formulario" method="POST">
        @csrf
        <div class="campo">
            <label for="id">ID (SKU):</label>
            <input required type="text" name="producto[id]" id="id">
        </div>
        <div class="campo">
            <label for="nombre">Nombre:</label>
            <input required type="text" name="producto[nombre]" id="nombre">
        </div>

        <div class="campo">
            <label for="descripcion">Descripción:</label>
            <textarea required name="producto[descripcion]" id="descripcion" cols="30" rows="5"></textarea>
        </div>

        <div class="campo">
            <label for="color">Color:</label>
            <input required type="text" name="producto[color]" id="color">
        </div>

        <div class="campo">
            <label for="precioventa">Precio de venta:</label>
            <input required type="number" min="1" max="99999" name="producto[precioventa]" id="precioventa">
        </div>

        <div class="campo">
            <label for="lote">Lote:</label>
            <input required type="number" min="1" max="99999" name="producto[lote]" id="lote">
        </div>

        <div class="campo">
            <label for="stock">Cantidad que ingresa:</label>
            <input required type="number" min="1" max="99999" name="producto[stock]" id="cantidad">
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
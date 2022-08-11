@extends('main')

@section('content')    
    <form action="/productos/registrar-entrada" class="formulario" method="POST">
        @csrf
        <p class="alinear-derecha is-required"> Campos obligatorios</p>
        <div class="campo">
            <label class="is-required" for="id">ID (SKU):</label>
            <input placeholder="Ej. HAV001" required type="text" value="" name="producto[id]" id="id">
        </div>

        <div class="campo">
            <label class="is-required" for="lote">Lote:</label>
            <input placeholder="Ej. 1" required type="number" min="1" max="99999" value="" name="producto[lote]" id="lote">
        </div>

        <div class="campo">
            <label class="is-required" for="stock">Cantidad que ingresa:</label>
            <input placeholder="Ej. 10" required type="number" min="1" max="99999" value="" name="producto[stock]" id="cantidad">
        </div>
        
        <div class="campo">
            <label class="is-required" for="proveedor">Proveedor:</label>
            <select required name="producto[idProveedor]" id="proveedor">    
                {{-- //Despliega en el select todos los proveedores que están registrados --}}
                @foreach ($proveedores as $proveedor) 
                    <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="campo">
            <label class="is-required" for="fecha">Fecha de ingreso:</label>
            <input type="date" name="producto[fechaIngreso]" id="fecha" required>
        </div>

        <div class="campo">
            <input class="boton boton-principal" type="submit" value="Registrar">
        </div>   
    </form>
@stop
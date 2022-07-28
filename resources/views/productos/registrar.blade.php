@extends('main')

@section('content')    
<form action="/productos/registrar" class="formulario" method="POST" enctype="multipart/form-data">
    @csrf
        <p class="alinear-derecha is-required"> Campos obligatorios</p>
        <div class="campo">
            <label class="is-required" for="id">ID (SKU):</label>
            <input required type="text" name="producto[id]" id="id">
        </div>
        <div class="campo">
            <label class="is-required" for="nombre">Nombre:</label>
            <input required type="text" name="producto[nombre]" id="nombre">
        </div>

        <div class="campo">
            <label class="is-required" for="imagen">Imagen:</label>
            <input required type="file" name="imagen" id="imagen" accept="image/*">
        </div>

        <div class="campo">
            <label class="is-required" for="descripcion">Descripción:</label>
            <textarea required name="producto[descripcion]" id="descripcion" cols="30" rows="5"></textarea>
        </div>

        <div class="campo">
            <label class="is-required" for="color">Color:</label>
            <input required type="text" name="producto[color]" id="color">
        </div>

        <div class="campo">
            <label class="is-required" for="precioventa">Precio de venta:</label>
            <input required type="number" min="1" max="99999" name="producto[precioventa]" id="precioventa">
        </div>

        <div class="campo">
            <label class="is-required" for="precioventa">Costo:</label>
            <input required type="number" min="1" max="99999" name="producto[costo]" id="costo">
        </div>

        <div class="campo">
            <label class="is-required" for="lote">Lote:</label>
            <input required type="number" min="1" max="99999" name="producto[lote]" id="lote">
        </div>

        <div class="campo">
            <label class="is-required" for="stock">Cantidad que ingresa:</label>
            <input required type="number" min="1" max="99999" name="producto[stock]" id="cantidad">
        </div>

        <div class="campo">
            <label class="is-required" for="stock">Cantidad mínima:</label>
            <input required type="number" min="1" max="99999" name="producto[cantidadMinima]" id="cantidadMinima">
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
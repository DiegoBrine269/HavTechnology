@extends('main')

@section('content')    
    <form action="/productos/actualizar" class="formulario" method="POST"  enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="producto[idOriginal]" value="{{ $producto->id }}">

        <div class="campo">
            <label for="nombre">Nombre:</label>
            <input value="{{ $producto->nombre }}" required type="text" name="producto[nombre]" id="nombre">
        </div>

        <div class="campo">
            <label for="">Imagen:</label>
            <img 
                @if (!isset($producto->imagen))
                    src="/img/default.png" 
                @else
                    src="/img/{{ $producto->imagen }}" 
                @endif 
                alt="Imagen de producto"
            >
            </div>
        
        <input 
            type="hidden" 
            name="imagenOriginal"
            @if (!isset($producto->imagen))
                value="" 
            @else
                value="/img/{{ $producto->imagen }}" 
            @endif 
        >

        <div class="campo">
            <label for="imagen">Nueva imagen:</label>
            <input type="file" name="nuevaImagen" id="imagen">
        </div>

        <div class="campo">
            <label for="descripcion">Descripción:</label>
            <textarea required name="producto[descripcion]" id="descripcion" cols="30" rows="10">{{ $producto->descripcion }}</textarea>
        </div>

        <div class="campo">
            <label for="color">Color:</label>
            <input value="{{ $producto->color }}" required type="text" name="producto[color]" id="color">
        </div>

        <div class="campo">
            <label for="precioventa">Precio de venta:</label>
            <input value="{{ $producto->precioVenta }}" required type="number" name="producto[precioventa]" id="precioventa">
        </div>

        {{-- <div class="campo">
            <label for="stock">Stock:</label>
            <input value="{{ $producto->stock }}" required type="number" min="1" max="9999" name="producto[stock]" id="cantidad">
        </div> --}}
        
        <div class="campo-dos">
            <input class="boton boton-principal" type="submit" value="Actualizar">
            <a href="/productos" class="boton">Volver atrás</a>
        </div>   
    </form>

    <h3>Productos únicos</h3>
    <table class="tabla" cellspacing=0>
        <thead>
            <th class="capitalize">ID Único</th>
            <th class="capitalize">Existe</th>
            <th class="capitalize">Lote</th>
            <th class="capitalize">Proveedor</th>
            <th class="capitalize">Acciones</th>
        </thead>
        <tbody>
                @foreach ($productosUnicos as $productoUnico)
                    <tr>
                        <td> {{ $productoUnico->idUnico }} </td>
                        <td> 
                            @if ($productoUnico->existe)
                                {{ 'Sí' }}
                            @else
                                {{ 'No' }}
                            @endif
                        </td>
                        <td> {{ $productoUnico->lote }} </td>
                        <td> {{ $productoUnico->nombre }} </td>
                        <td class="acciones">
                            <a href="/producto-unico/eliminar?id={{ $productoUnico->idUnico }}">Eliminar</a>
                            <a href="/productos/barcode?id={{ $productoUnico->idUnico }}">Generar código</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
@stop
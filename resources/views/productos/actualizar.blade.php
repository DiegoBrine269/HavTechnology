@extends('main')

@section('content')    
    <form action="/productos/actualizar" class="formulario" method="POST"  enctype="multipart/form-data">
        @csrf
        <p class="alinear-derecha is-required"> Campos obligatorios</p>
        <input type="hidden" name="producto[idOriginal]" value="{{ $producto->id }}">

        <div class="campo">
            <label class="is-required" for="nombre">Nombre:</label>
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
            <label class="is-required" for="descripcion">Descripción:</label>
            <textarea required name="producto[descripcion]" id="descripcion" cols="30" rows="10">{{ $producto->descripcion }}</textarea>
        </div>

        <div class="campo">
            <label class="is-required" for="stock">Cantidad mínima:</label>
            <input value="{{ $producto->cantidadMinima }}" required type="number" min="1" max="99999" name="producto[cantidadMinima]" id="cantidadMinima">
        </div>

        <div class="campo">
            <label class="is-required" for="color">Color:</label>
            <input value="{{ $producto->color }}" required type="text" name="producto[color]" id="color">
        </div>

        <div class="campo">
            <label class="is-required" for="precioventa">Precio de venta:</label>
            <input value="{{ $producto->precioVenta }}" required type="number" name="producto[precioventa]" id="precioventa">
        </div>

        <div class="campo">
            <label class="is-required" for="precioventa">Costo:</label>
            <input value="{{ $producto->costo }}" required type="number" min="1" max="99999" name="producto[costo]" id="costo">
        </div>
        
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
            <th class="capitalize">Fecha de ingreso</th>
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
                        <td> 
                            @php
                                $date = date_create($productoUnico->fechaIngreso);
                            @endphp
                            {{ date_format($date, 'd/m/Y') }} 
                        </td>
                        <td class="acciones">
                            <a title="Eliminar" class="fa-solid fa-trash-can" href="/producto-unico/eliminar?id={{ $productoUnico->idUnico }}"></a>
                            <a title="Generar código de barras" class="fa-solid fa-barcode" href="/productos/barcode?id={{ $productoUnico->idUnico }}"></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
@stop
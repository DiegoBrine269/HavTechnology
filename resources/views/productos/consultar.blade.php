@extends('main')

@section('content')    
    <form action="/productos/actualizar" class="formulario" method="POST"  enctype="multipart/form-data">
        @csrf
        <input readonly type="hidden" name="producto[idOriginal]" value="{{ $producto->id }}">

        {{-- <div class="campo">
            <label for="nombre">Nombre:</label>
            <input readonly value="{{ $producto->nombre }}" required type="text" name="producto[nombre]" id="nombre">
        </div> --}}

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

        <div class="campo">
            <label for="descripcion">Descripción:</label>
            <textarea readonly required name="producto[descripcion]" id="descripcion" cols="30" rows="10">{{ $producto->descripcion }}</textarea>
        </div>

        <div class="campo">
            <label for="stock">Cantidad mínima:</label>
            <input readonly value="{{ $producto->cantidadMinima }}" required type="number" min="1" max="99999" name="producto[cantidadMinima]" id="cantidadMinima">
        </div>

        <div class="campo">
            <label for="color">Color:</label>
            <input readonly value="{{ $producto->color }}" required type="text" name="producto[color]" id="color">
        </div>

        <div class="campo">
            <label for="precioventa">Precio de venta:</label>
            <input readonly value="{{ $producto->precioVenta }}" required type="number" name="producto[precioventa]" id="precioventa">
        </div>

        <div class="campo">
            <label for="precioventa">Costo:</label>
            <input readonly value="{{ $producto->costo }}" required type="number" min="1" max="99999" name="producto[costo]" id="costo">
        </div>

        {{-- <div class="campo">
            <label for="stock">Stock:</label>
            <input value="{{ $producto->stock }}" required type="number" min="1" max="9999" name="producto[stock]" id="cantidad">
        </div> --}} 
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
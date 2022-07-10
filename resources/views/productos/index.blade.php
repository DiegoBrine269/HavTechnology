@extends('main')

@section('content')
    <div class="control">
        <form method="GET" action="">
            <input class="caja-de-texto" type="text" name="patron" id="patron">
            <input class="boton boton-principal" type="submit" value="Buscar" id="buscar">
        </form>
        <div class="opciones">
            <a href="/{{ strtolower($titulo) }}/registrar" class="boton">Registrar nuevo</a>
            <a href="/{{ strtolower($titulo) }}/registrar-entrada" class="boton">Entrada de producto existente</a>
        </div>
    </div>
    
    <div class="table-container">
        <table class="tabla" cellspacing="0">
            <thead>
                <th class="capitalize">ID</th>
                <th class="capitalize">Nombre</th>
                <th class="capitalize">Imagen</th>
                <th class="capitalize">Descripción</th>
                <th class="capitalize">Color</th>
                <th class="capitalize">Precio de venta</th>
                <th class="capitalize">Stock</th>
                <th>Acciones</th>
            </thead>
            <tbody>
                @foreach ($datos as $dato)
                    <tr>
                        <td> {{ $dato->id }} </td>
                        <td> {{ $dato->nombre }} </td>
                        <td>
                            <img 
                                loading="lazy"
                                @if (!isset($dato->imagen))
                                    src="/img/default.png" 
                                @else
                                    src="/img/{{ $dato->imagen }}" 
                                @endif
                                alt="Imagen de producto"
                            >  
                        </td>
                        <td> {{ $dato->descripcion }} </td>
                        <td> {{ $dato->color }} </td>
                        <td> $ {{ $dato->precioVenta }} </td>
                        <td> {{ $dato->stock }} </td>
                        <td>
                            <div class="acciones">
                                <a class="fa-solid fa-eye" href="/{{ strtolower($titulo) }}/consultar?id={{ $dato->id }}"></a>
                                <a class="fa-solid fa-pen-to-square" href="/{{ strtolower($titulo) }}/actualizar?id={{ $dato->id }}"></a>
                                <a class="fa-solid fa-trash-can" onclick="return confirm('¿Seguro que desea eliminar el registro?')" href="/{{ strtolower($titulo) }}/eliminar?id={{ $dato->id }}"></a>
                                <a class="fa-solid fa-barcode" href="/{{ strtolower($titulo) }}/barcode?id={{ $dato->id }}"></a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@stop
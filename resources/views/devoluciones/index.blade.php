@extends('main')

@section('content')
<div class="control">
    <form method="GET" action="">
        <input class="caja-de-texto" type="text" name="patron" id="patron">
        <input class="boton boton-principal" type="submit" value="Buscar" id="buscar">
    </form>
    <div class="opciones">
        <a href="/{{ strtolower($titulo) }}/registrar" class="boton">Registrar nueva devolución</a>
    </div>
</div>

<div class="table-container">
    <table class="tabla" cellspacing=0>
        <thead>
            <th class="capitalize">ID</th>
            <th class="capitalize">ID del producto</th>
            <th class="capitalize">Pérdida total</th>
            <th class="capitalize">Fecha</th>
            <th>Acciones</th>
        </thead>
        <tbody>
            @foreach ($datos as $dato)
                <tr>
                    <td> {{ $dato->id }} </td>
                    <td> {{ $dato->idProducto }} </td>
                    <td>
                        @if ($dato->perdidaTotal == '1')
                            Sí  
                        @else
                            No
                        @endif 
                    </td>
    
                    <td> 
                        @php
                            $date = date_create($dato->fecha);
                        @endphp
                        {{ date_format($date, 'd/m/Y') }}     
                    </td>
                    <td>
                        <div class="acciones">
                            <a title="Consultar" class="fa-solid fa-eye" href="/{{ strtolower($titulo) }}/consultar?id={{ $dato->id }}"></a>
                            <a title="Actualizar" class="fa-solid fa-pen-to-square" href="/{{ strtolower($titulo) }}/actualizar?id={{ $dato->id }}"></a>
                            <a title="Eliminar" class="fa-solid fa-trash-can" onclick="return confirm('¿Seguro que desea eliminar el registro?')" href="/{{ strtolower($titulo) }}/eliminar?id={{ $dato->id }}"></a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>
@stop
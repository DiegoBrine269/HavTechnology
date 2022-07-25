@extends('main')

@section('content')
<div class="control">
    <form method="GET" action="">
        <input class="caja-de-texto" type="text" name="patron" id="patron">
        <input class="boton boton-principal" type="submit" value="Buscar" id="buscar">
    </form>
    <div class="opciones">
        <a href="/{{ strtolower($titulo) }}/registrar" class="boton">Crear nuevo presupuesto</a>
    </div>
</div>

<div class="table-container">
    <table class="tabla" cellspacing=0>
        <thead>
            <th class="capitalize">ID (folio)</th>
            <th class="capitalize">Destinatario</th>
            <th class="capitalize">Correo</th>
            <th>Acciones</th>
        </thead>
        <tbody>
            @foreach ($datos as $dato)
                <tr>
                    <td> {{ substr($dato->id, 0, -4) }} </td>
                    <td> {{ $dato->nombreCliente }} </td>
                    <td> {{$dato->correo}} </td>
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
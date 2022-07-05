@extends('main')

@section('content')
    <div class="control">
        <form method="GET" action="">
            <input class="caja-de-texto" type="text" name="patron" id="patron">
            <input class="boton boton-principal" type="submit" value="Buscar" id="buscar">
        </form>
    
        <div class="opciones">
            <a href="/{{ strtolower($titulo).'/registrar' }}" class="boton boton-registrar">Registrar nuevo</a>
        </div>
    </div>

    <table class="tabla" cellspacing=0>
        <thead>
            <th class="capitalize">ID</th>
            <th class="capitalize">Nombre</th>
            <th class="capitalize">Teléfono</th>
            <th class="capitalize">Correo</th>
            <th>Acciones</th>
        </thead>
        <tbody>
            @foreach ($datos as $dato)
                <tr>
                    <td> {{ $dato->id }} </td>
                    <td> {{ $dato->nombre }} </td>
                    <td> {{ $dato->telefono }} </td>
                    <td> {{ $dato->correo }} </td>
                    <td>
                        <div class="acciones">
                            <a href="/{{ strtolower($titulo) }}/consultar?id={{ $dato->id }}">Consultar</a>
                            <a href="/{{ strtolower($titulo) }}/actualizar?id={{ $dato->id }}">Actualizar</a>
                            <a href="/{{ strtolower($titulo) }}/eliminar?id={{ $dato->id }}">Eliminar</a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop


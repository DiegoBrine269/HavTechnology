@extends('main')

@section('content')
    <div class="control">
        <form method="GET" action="">
            <input class="caja-de-texto" type="text" name="patron" id="patron">
            <input class="boton boton-principal" type="submit" value="Buscar" id="buscar">
        </form>
    
        @if (Auth::user()->is_admin == '1')
            <div class="opciones">
                <a href="/{{ strtolower($titulo).'/registrar' }}" class="boton boton-registrar">Registrar nuevo</a>
            </div>
        @endif
    </div>

    <div class="table-container">
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
                                <a title="Consultar" class="fa-solid fa-eye" href="/{{ strtolower($titulo) }}/consultar?id={{ $dato->id }}"></a>
                                @if (Auth::user()->is_admin == '1')
                                    <a title="Actualizar" class="fa-solid fa-pen-to-square" href="/{{ strtolower($titulo) }}/actualizar?id={{ $dato->id }}"></a>
                                    <a title="Eliminar" class="fa-solid fa-trash-can" onclick="return confirm('¿Seguro que desea eliminar el registro?')" href="/{{ strtolower($titulo) }}/eliminar?id={{ $dato->id }}"></a>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@stop


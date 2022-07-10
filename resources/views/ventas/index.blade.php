@extends('main')

@section('content')
<div class="control">
    <form method="GET" action="">
        <input class="caja-de-texto" type="text" name="patron" id="patron">
        <input class="boton boton-principal" type="submit" value="Buscar" id="buscar">
    </form>
    <div class="opciones">
        <a href="/{{ strtolower($titulo) }}/registrar" class="boton">Registrar nueva</a>
    </div>
    <h3>Reportes</h3>
    <div class="opciones">
        <a href="/{{ strtolower($titulo) }}/reporte?tipo=anual" class="boton">Anual</a>
        <a href="/{{ strtolower($titulo) }}/reporte?tipo=mensual" class="boton">Mensual</a>
        <a href="/{{ strtolower($titulo) }}/reporte?tipo=semanal" class="boton">Semanal</a>
        <a href="/{{ strtolower($titulo) }}/reporte?tipo=diario" class="boton">Hoy</a>
    </div>

    <p class="bold">Por rango de fechas</p>
    <div class="opciones">
        <form method="GET" action="" id="form_reporte">
            <div class="contenedor-rango">
                <div>
                    <label for="">Desde:</label>
                    <input required type="date" name="fechaInicial" id="fechaInicial">
                </div>
                <div>
                    <label for="">Hasta: </label>
                    <input required type="date" name="fechaFinal" id="fechaFinal">
                </div>
                <input class="boton boton-principal" type="submit" value="Generar" id="submit_reporte">
            </div>
        </form>
    </div>
    <p class="mensaje mensaje-error invisible" id="mensajeFechas"></p>
</div>
<div class="table-container">
    <table class="tabla" cellspacing=0>
        <thead>
            <th class="capitalize">ID</th>
            <th class="capitalize">Cliente</th>
            <th class="capitalize">Fecha</th>
            <th class="capitalize">Total</th>
            <th>Acciones</th>
        </thead>
        <tbody>
            @foreach ($datos as $dato)
                <tr>
                    <td> {{ $dato->id }} </td>
                    <td> {{ $dato->nombreCliente }} </td>
                    <td> 
                        @php
                            $date = date_create($dato->fecha);
                        @endphp
                        {{ date_format($date, 'd/m/Y') }} 
                    </td>
                    <td> $ {{ $dato->total }} </td>
                    <td>
                        <div class="acciones">
                            <a class="fa-solid fa-eye" href="/{{ strtolower($titulo) }}/consultar?id={{ $dato->id }}"></a>
                            <a class="fa-solid fa-pen-to-square" href="/{{ strtolower($titulo) }}/actualizar?id={{ $dato->id }}"></a>
                            <a class="fa-solid fa-trash-can" onclick="return confirm('¿Seguro que desea eliminar el registro?')" href="/{{ strtolower($titulo) }}/eliminar?id={{ $dato->id }}"></a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script src="/js/reporte.js"></script>
@stop
@extends('main')

@section('content')    
    <div class="control">
        <form method="GET" action="">
            <input class="caja-de-texto" type="text" name="id">
            <input class="boton boton-principal" type="submit" value="Buscar">
        </form>
    </div>
    
    @if (is_null($producto))
        <p>No se encontró información sobre el producto</p>
    @else
      
        <h3 style="margin-bottom:0.5rem">Información sobre el producto</h3>
        <table class="tabla" cellspacing=0 style="margin-top:0">
            <thead>
                <th class="capitalize">ID</th>
                <th class="capitalize">Nombre</th>
                <th class="capitalize">Disponibilidad</th>
            </thead>
            <tbody>
                <td>{{ $producto->id }}</td>
                <td>{{ $producto->nombre }}</td>
                <td>{{ $producto->existe }}</td>
            </tbody>
        </table>
        
        <h3 style="margin-bottom:0.5rem">Venta relacionada con el producto</h3>
        @if (!is_null($venta))       
            <table class="tabla" cellspacing=0 style="margin-top:0">
                <thead>
                    <th class="capitalize">Cliente</th>
                    <th class="capitalize">Fecha</th>
                </thead>
                <tbody>
                    <td>{{ $venta->nombre }}</td>
                    <td>{{ date('d/m/Y', strtotime($venta->fecha)) }}</td>
                </tbody>
            </table>    
        @else 
            <p>El producto no ha sido vendido</p>
        @endif

        <h3 style="margin-bottom:0.5rem">Devolución relacionada con el producto</h3>
        @if (!is_null($devolucion))       
            <table class="tabla" cellspacing=0 style="margin-top:0">
                <thead>
                    <th class="capitalize">Cliente</th>
                    <th class="capitalize">Fecha</th>
                    <th class="capitalize">Perdida Total</th>
                </thead>
                <tbody>
                    <td>{{ $venta->nombre }}</td>
                    <td>{{ date('d/m/Y', strtotime($devolucion->fecha)) }}</td>
                    <td>
                        @if ($devolucion->perdidaTotal)
                            Sí                    
                        @else    
                            No    
                        @endif
                    </td>
                </tbody>
            </table>    
        @else 
            <p>El producto no ha sido devuelto</p>
        @endif
    @endif
@stop
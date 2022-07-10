@extends('main')

@section('content')
    <h2>Bienvenido, {{ Auth::user()->name }}.</h2>
    @if (Auth::user()->is_admin == '1')
        <p>Rol: <span class="bold">Administrador</span></p>            
    @else
        <p>Rol: <span class="bold">Empleado</span></p>
    @endif
    <p>Seleccione una opción del menú de navegación para comenzar a trabajar</p>
@stop

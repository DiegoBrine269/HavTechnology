<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> {{ ucfirst($titulo) }} </title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css">
    <link rel="icon" href="{{ url('/css/logo.jpg') }}">    
    <link rel="stylesheet" href="{{ url('/css/index.css') }}">
</head>
<body>

    <header class="header">
        <div class="contenedor contenido-header">
            <h1>HAV Technology</h1>
            <div>
                <p style="margin:0">Nombre: <span class="bold"> {{ Auth::user()->name }} </span></p>
                @if (Auth::user()->is_admin == '1')
                    <p style="margin:0">Rol: <span class="bold">Administrador</span></p>            
                @else
                    <p style="margin:0">Rol: <span class="bold">Empleado</span></p>
                @endif
            </div>
        </div>
    </header>

    <main class="contenedor">
        <div class="sidebar">
            <ul class="menu">
                <li><a class="menu-item" href="/productos">Productos</a></li>
                <li><a href="/proveedores" class="menu-item">Proveedores</a></li>
                <li><a href="/clientes" class="menu-item">Clientes</a></li>
                <li><a href="/ventas" class="menu-item">Ventas</a></li>
                <li><a href="/devoluciones" class="menu-item">Devoluciones</a></li>
                <li><a href="/presupuestos" class="menu-item">Presupuestos</a></li>
                {{-- <li><a href="" class="menu-item">Cerrar Sesión</a></li> --}}
                <li>
                    <a class="dropdown-item menu-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                        {{ __('Cerrar Sesión') }}
                    </a>
                </li>

            </ul>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>


        
        <div class="contenido-principal"> 
            <h2>{{ ucfirst($titulo) }}</h2>
            @if (isset($resultado))
                @switch($resultado )
                    @case('0')
                        <p class="mensaje mensaje-error"> Ha habido un error </p>
                    @break
                    @case('1')
                        <p class="mensaje mensaje-ok"> Registro guardado exitosamente </p>
                        @break
                    @case('2')
                        <p class="mensaje mensaje-ok"> Registro actualizado exitosamente </p>
                        @break
                    @case('3')
                        <p class="mensaje mensaje-ok"> Registro eliminado exitosamente </p>
                        @break
                    @case('4')
                        <p class="mensaje mensaje-error"> El registro no se ha podido eliminar, pues existen registros que dependen de este (Revisar ventas, devoluciones o presupuestos y eliminarlos primero) </p>
                        @break
                    @default   
                        @break; 
                @endswitch
            @endif
                    

            @section('content')
            @show            
        </div>
    </main>

    <footer>
        <div class="contenedor contenido-footer">
            <p>Aplicación web diseñada por Diego Oloarte</p>
        </div>
    </footer>

    <script src="/js/main.js"></script>

</body>
</html>
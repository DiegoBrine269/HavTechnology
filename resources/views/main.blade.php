<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> {{ ucfirst($titulo) }} </title>
    <link rel="stylesheet" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css">
    <link rel="stylesheet" href="{{ url('/css/index.css') }}">
</head>
<body>

    <header class="header">
        <div class="contenedor contenido-header">
            <h1>HAVTechnology</h1>
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
                <li><a href="" class="menu-item">Cerrar Sesión</a></li>
            </ul>
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
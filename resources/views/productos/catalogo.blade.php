<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        html {
            width:100%;
            margin: 40px;
        }

        header {
            height: 70px;
            margin-top: 0;
            padding-top: 0;
        }

        .encabezado {
            font-size: 14px;
            width: 100%;
            background-color: #ffffff;
            height: 70px;
            margin-top: 0;
            padding-top: 0;
        }

        
        .titulo {
            /* display: inline-block; */
            height: 100%;
            /* padding-bottom: 40px; */
        }
        
        .titulo h4, .domicilio, .titulo h2 {
            margin: 0;
        }  

        .titulo h2 {
            margin-top: 10px;
        }  

        .domicilio {
            font-size: 10px;
        }

        .encabezado tr {
            max-height: 70px;
            /* padding: 40px; */
        }

        .encabezado tr td{
            background-color: #ffffff;
        }

        .informacion p{
            font-size: 12px;
            text-align: right;
            font-size: 10px;
        }

        h1, h2, h3, h4{
            margin: 5px;
        }
    
        .table-container { 
            /* overflow-x:auto; */
        }

        .tabla {
            margin-top: 30px;
            max-width: 100%;
            width: 100%;
            font-size: 12px;
            border: none;
            border-collapse:collapse;
        }

        .tabla th{
            color: white;
            background-color: #3c4394;
            padding: 7px;
        }

        .tabla td {
            text-align: center;
            padding: 0 10px;
        }

        .tabla td img {
            max-width: 50px;
        }

        @media (min-width: 768px) {
            .tabla td img {
                max-width: 100px;
            }        
        }

        tbody tr:nth-child(odd){
            background-color: #dfdfdf;
        }

        footer {
            text-align: right;
            font-size: 14px;
        }

        .bold {
            font-weight: bold;
        }

        .contenedor-logo{
            width: 80px;
        }

        .logo {
            width: 70px;
            display: inline;
            height: 70px;
        }

    </style>
</head>
<body>
    <header>
        <table class="encabezado">
            <tr>
                <td class="contenedor-logo">
                    <img class="logo"src="https://i.ibb.co/nDBv3CD/logo.jpg" alt="">
                </td>
                <td class="titulo">
                    <h4>HAV Technology</h4>
                    <p class="domicilio">Calle Colima, MZ 22, Lote 17, Col. Buenavista, C.P. 09700, Alcaldía Iztapalapa, CDMX</p>
                    <h2>Catálogo de productos</h2>
                </td>
                <td class="informacion">
                    <p>RFC: LECH860130NU8</p>
                    <p>Horacio Lechuga Castillo</p>
                </td>
            </tr> 
        </table>
    </header>

    <div class="table-container" cellspacing="0" cellpadding="0">
        <table class="tabla">
            <thead>
                <th>Nombre</th>
                <th>Imagen</th>
                <th>Descripcion</th>
                <th>Color</th>
                <th style="width:100px">Precio</th>
                <th>Detalles</th>
            </thead>
            <tbody>
                @foreach ($productos as $producto)
                    @if ($producto->stock > 0)
                        <tr>
                            <td> {{ $producto->nombre }} </td>
                            <td>
                                <img 
                                    @if (!isset($producto->imagen))
                                        src="{{public_path("img")}}/default.png" 
                                    @else
                                        src="{{public_path("img")}}/{{ $producto->imagen }}" 
                                    @endif
                                >  
                            </td>
                            <td>{{ $producto->descripcion }}</td>
                            <td>{{ $producto->color }}</td>
                            <td>$ {{ $producto->precioVenta }}</td>
                            <td>
                                @if ($producto->stock < $producto->cantidadMinima)
                                    Preguntar por existencias                                    
                                @endif
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>

    <footer>
    </footer>
</body>
</html>
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
            height: 120px;
            margin-top: 0;
            padding-top: 0;
        }

        .encabezado {
            font-size: 14px;
            width: 100%;
            background-color: #ffffff;
            height: 120px;
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
            max-height: 120px;
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
            overflow-x:auto;
        }

        .tabla {
            margin-top: 10px;
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
                    <p class="domicilio">Calle Colima MZ 22, Lote 17, Col. Buenavista, C.P. 09700, Alcaldía Iztapalapa, CDMX</p>
                    @if ($tipo === 'rango')
                        <h2 style="font-size:16px;">Reporte de ventas del {{ date("d/m/Y", strtotime($fechaInicial)) }} a {{ date("d/m/Y", strtotime($fechaFinal)) }}</h2>
                    @else
                        <h2>Reporte {{ $tipo }} de ventas</h2>            
                    @endif 
                </td>
                <td class="informacion">
                    <p>RFC: LECH860130NU8</p>
                    <p>Documento generado el: <span>{{ $fecha }}</span></p>
                </td>
            </tr> 
        </table>
    </header>

    <div class="table-container" cellspacing="0" cellpadding="0">
        <table class="tabla">
            <thead>
                <th>ID</th>
                <th>Cliente</th>
                <th>Fecha</th>
                <th>Total</th>
            </thead>
            <tbody>
                @foreach ($ventas as $venta)
                    <tr>
                        <td> {{ $venta->id }} </td>
                        <td> {{ $venta->nombreCliente }} </td>
                        <td> 
                            @php
                                $date = date_create($venta->fecha);
                            @endphp
                            {{ date_format($date, 'd/m/Y') }} 
                        </td>
                        <td> $ {{ $venta->total }} </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <footer>
        <p>Total: <span class="bold">$ {{ $total }}</span></p>
    </footer>
</body>
</html>
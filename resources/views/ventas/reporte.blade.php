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
            margin: 50px 40px;
        }

        header .encabezado, header .informacion {
            width: 49%;
            display: inline-block;
            font-size: 14px;
        }

        header .informacion {
            text-align: right;
            font-size: 12px;
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

    </style>
</head>
<body>
    <header>
        <div class="encabezado">
            <h4>HAV Technology</h4>
            @if ($tipo === 'rango')
                <h2 style="font-size:16px;">Reporte de ventas del {{ date("d/m/Y", strtotime($fechaInicial)) }} a {{ date("d/m/Y", strtotime($fechaFinal)) }}</h2>
            @else
                <h2">Reporte {{ $tipo }} de ventas</h2>            
            @endif

            
                
        </div>

        <div class="informacion">
            <p>Documento generado el: <span>{{ $fecha }}</span></p>
        </div>
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
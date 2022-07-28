<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="refresh" content="3; url=http://127.0.0.1:8000/productos">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        html {
            width:100%;
            margin: 40px 60px;
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

        p, li {
            font-size: 12px;
        }

        .bold {
            font-weight: bold;
        }

        .alinear-izquierda {
            text-align: left!important;
        }

        .alinear-derecha {
            text-align: right!important;
        }
        
        .titulo {
            /* display: inline-block; */
            height: 100%;
            /* padding-bottom: 40px; */
        }
        
        .titulo h4, .domicilio, .titulo h2 {
            margin: 0;
        }  

        .domicilio {
            font-size: 10px;
        }

        .encabezado tr {
            max-height: 100px;
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

        h1, h2, h3, h4, h5{
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
            border: 1px solid #000;
            border-collapse: collapse;
        }

        .tabla, .tabla td, .tabla th {
            border: 1px solid #000;
        }

        .tabla th{
            color: white;
            background-color: #3c4394;
            padding: 7px;
        }

        .tabla td {
            text-align: center;
            padding: 1px 5px;
        }

        .tabla td img {
            max-width: 50px;
        }

        @media (min-width: 768px) {
            .tabla td img {
                max-width: 100px;
            }        
        }

        /* tbody tr:nth-child(odd){
            background-color: #dfdfdf;
        } */

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
    <script>
    </script>
    <header>
        <table class="encabezado">
            <tr>
                <td class="contenedor-logo">
                    <img class="logo"src="https://i.ibb.co/nDBv3CD/logo.jpg" alt="">
                </td>
                <td class="titulo">
                    <h4>HAV Technology</h4>
                    <p class="domicilio">Calle Colima, MZ 22, Lote 17, Col. Buenavista, C.P. 09700, Alcaldía Iztapalapa, CDMX</p>
                </td>
                <td class="informacion">
                    <p>RFC: LECH860130NU8</p>
                    <p>Horacio Lechuga Castillo</p>
                    <p>Ciudad de México, a <span>{{ $fecha }}</span></p>
                </td>
            </tr> 
        </table>
    </header>

    <p class="bold">
        @if (is_null($nuevoPresupuesto->nombreCliente) || $nuevoPresupuesto->nombreCliente == '')
            A quien corresponda:
        @else
            {{ 'Sr(a). ' . $nuevoPresupuesto->nombreCliente . ':' }}
        @endif
    </p>
    <p>Por medio de la presente, reciba un cordial saludo, así mismo nos permitimos poner a su consideración la siguiente propuesta:</p>

    <div class="table-container" cellspacing="0" cellpadding="0">
        <table class="tabla">
            <thead>
                <tr>
                    <td class="bold alinear-izquierda">Concepto</td>
                    <td class="bold">Cantidad</td>
                    <td class="bold">Precio unitario</td>
                    <td class="bold">Total</td>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 0;
                    $total = 0;
                @endphp
                @foreach ($productos as $producto)
                    <tr>
                        <td class="alinear-izquierda">{{ $producto->nombre }}</td>
                        <td>{{ $producto->cantidad }}</td>
                        <td class="alinear-derecha">$ {{ $producto->precioVenta }}</td>
                        <td class="alinear-derecha">$ {{number_format($producto->cantidad * $producto->precioVenta, 2)}} </td>
                        @php
                            $total += $producto->cantidad * $producto->precioVenta;
                        @endphp
                    </tr>
                    @php
                        $i++;
                    @endphp    
                @endforeach
            </tbody>
        </table>
    </div>

    <p class="alinear-derecha"><span class="bold">Total: </span> $ {{number_format($total, 2)}} </p>

    <p class="bold">Precio válido hasta el {{ $fechaLimite }}</p>
    <p class="bold">El precio ya incluye IVA
        @if ($nuevoPresupuesto->envio)
            y envío
        @endif
    </p>
    <p class="bold">Garantía de 30 días a partir de la entrega contra cualquier defecto de fabricación, esto no incluye mal conexionado, uso fuera de sus parámetros, humedad, tornillos barridos, etc.</p>

    <h5>Cuentas para transferencia de pago:</h5>

    <div class="table-container" cellspacing="0" cellpadding="0">
        <table class="tabla">
            <tbody>
                <tr>
                    <td></td>
                    <td class="bold">BBVA (Bancomer)</td>
                    <td class="bold">Banco Azteca</td>
                </tr>
                <tr>
                    <td class="bold alinear-izquierda">Cuenta CLABE</td>
                    <td>012 180 02836576818 4</td>
                    <td>1271 8001 3782 1262 09</td>
                </tr>
                <tr>
                    <td class="bold alinear-izquierda">Número de cuenta</td>
                    <td>283 657 6818</td>
                    <td>3793 1378 2126 20</td>
                </tr>
                <tr>
                    <td class="bold alinear-izquierda">Número de tarjeta</td>
                    <td>4152 3138 3821 4208</td>
                    <td>4027 6657 4278 5471</td>
                </tr>
                <tr>
                    <td class="bold alinear-izquierda">Nombre del beneficiario</td>
                    <td colspan="2">Horacio Lechuga Castillo</td>
                </tr>
            </tbody>
        </table>
    </div>

    <p><span class="bold">Nota:</span> La transferencia electrónica deberá hacerse a nombre de Horacio Lechuga Castillo.</p>
    <p>Correo electrónico: lechugahlc@gmail.com</p>
    <p>WhatsApp: 55 4878 8421</p>
    <p>Teléfono oficina: 55 8373 2899</p>
    <p>Sitio web: <a href="https://havtechnology.mercadoshops.com.mx/">havtechnology.mercadoshops.com.mx</a></p>


    <p>Los datos fundamentales que se requieren para la facturación son los siguientes:</p>
    <ul>
        <li>RFC</li>
        <li>Razón social</li>
        <li>Régimen fiscal</li>
        <li>Código postal de su domicilio fiscal</li>
        <li>Correo electrónico</li>
        <li>Uso de CFDI</li>
        <li>Forma de pago</li>
    </ul>


    <p>El envío se realizará a través de Estafeta o DHL.</p>
    <p>Para ello, requerimos los siguientes datos:</p>
    <ul>
        <li>Código postal</li>
        <li>Calle</li>
        <li>Número</li>
        <li>Colonia</li>
        <li>Municipio</li>
        <li>Estado</li>
        <li>Entre calles</li>
        <li>Referencia (color de casa, negocio o características particulares del domicilio)</li>
        <li>Nombre de quien recibe</li>
        <li>Teléfono</li>
    </ul>

    <footer>
    </footer>
</body>
</html>
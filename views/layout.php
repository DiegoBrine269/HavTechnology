<?php
    if(!isset($_SESSION)){
        session_start();
    }

    if(!isset($titulo)){
        $titulo = "HAV Technology";
    }

    if(!isset($pagina)){
        $pagina = "inicio";
    }

    $hora = new DateTime("now", new DateTimeZone('America/Mexico_City'));
    $hora = $hora->format('G');

    $mensajeBienvenida = "Bienvenid@";
    $usuario = $_SESSION['usuario'] ?? '';

    if($hora >= 0 && $hora <  12)
        $mensajeBienvenida = "Buenos días";
    else if ($hora >= 12 && $hora <  20) 
        $mensajeBienvenida = "Buenas tardes";
    else if ($hora >= 20 && $hora <=  24)
        $mensajeBienvenida = "Buenas noches"
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> <?php echo $titulo ?> </title>
    <link rel="stylesheet" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css">
    <link rel="stylesheet" href="css/index.css">

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
                <li><a href="/clientes" class="menu-item">Clientes</a></li>
                <li><a href="/ventas" class="menu-item">Ventas</a></li>
                <li><a href="/devoluciones" class="menu-item">Devoluciones</a></li>
                <li><a href="" class="menu-item">Cerrar Sesión</a></li>
            </ul>
        </div>

        <div class="contenido-principal"> 
            <h2>
                <?php
                    if($pagina == "inicio") 
                        echo $mensajeBienvenida . ', ' . $usuario; 
                    else 
                        echo $pagina;
                ?>
            </h2>
            <?php echo $contenido ?>
        </div>
    </main>

    <footer>
        <div class="contenedor contenido-footer">
            <p>Aplicación web diseñada por Diego Oloarte</p>
        </div>
    </footer>

</body>
</html>
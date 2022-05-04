<?php
    if(!isset($_SESSION)){
        session_start();
    }

    $auth = $_SESSION['login'] ?? false;

    if(!isset($titulo)){
        $titulo = "HAV Technology";
    }
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

    <header class="contenedor">
        <navbar>
            <ul>
                <li>Inicio</li>
            </ul>
        </navbar>
    </header>

    <?php echo $contenido ?>

    <footer>
      <p>Aplicación web diseñada por Diego Oloarte</p>
    </footer>

</body>
</html>

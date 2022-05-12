<!-- Productos -->

<?php
    $auth = $_SESSION['auth'] ?? false;

    if(!$auth) {
        header("Location: /login");
    }
?>

<div class="control">
    <form method="GET" action="">
        <input class="caja-de-texto" type="text" name="patron" id="patron">
        <input class="boton boton-principal" type="submit" value="Buscar">
    </form>

    <div class="opciones">
        <button type="button" class="boton">Registrar</button>
        <button type="button" class="boton">Actualizar</button>
        <button type="button" class="boton">Eliminar</button>
    </div>
</div>

<?php include __DIR__ . '/../tabla.php'?>

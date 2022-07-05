<!-- Productos -->

<?php
    $auth = $_SESSION['auth'] ?? false;

    //Indica si en la tabla de la BD la PK es autoincrementable o no
    if(!isset($autoIncrement))
        $autoIncrement = true;

    // if(!$auth) {
    //     header("Location: /login");
    // }
?>

<div class="control">
    <form method="GET" action="">
        <input class="caja-de-texto" type="text" name="patron" id="patron">
        <input class="boton boton-principal" type="submit" value="Buscar">
    </form>

    <div class="opciones">
        <a href="/<?php echo strtolower($pagina).'/crear'?>" class="boton boton-registrar">Registrar</a>
        <button type="button" class="boton">Actualizar</button>
        <button type="button" class="boton">Eliminar</button>
    </div>
</div>

<?php include __DIR__ . '/../tabla.php'?>

<script src="js/crud.js"></script>
<!-- Productos -->

<?php
    $auth = $_SESSION['auth'] ?? false;

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
        <a href="#modal-registrar" class="boton">Registrar</a>
        <button type="button" class="boton">Actualizar</button>
        <button type="button" class="boton">Eliminar</button>
    </div>
</div>

<?php include __DIR__ . '/../tabla.php'?>

<div class="modal" id="modal-registrar">
    <div class="modal-contenido">
        <a href="#">x</a>
        <form action="">

            <?php foreach($headers as $header){ ?>
                <div class="campo">
                    <label for=""><?php echo $header ?> </label>
                    <input type="text" value="">
                </div class="campo">
            <?php
                }
            ?>


            <div class="campo">
                <input class="boton boton-principal" type="submit" value="Guardar">
            </div>
        </form>
    </div>
</div>

<script src="js/crud.js"></script>
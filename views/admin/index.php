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
        <a href="#modal-registrar" class="boton boton-registrar">Registrar</a>
        <button type="button" class="boton">Actualizar</button>
        <button type="button" class="boton">Eliminar</button>
    </div>
</div>

<?php include __DIR__ . '/../tabla.php'?>

<div class="modal invisible" id="modal-registrar">
    <div class="modal-contenido">
        <a href="#">x</a>
        <h2><?php echo $modalTitulo ?> </h2>
        <form action="">

            <?php 
                $i = 0;
                foreach($labels as $label) { 
                    if ($autoIncrement === false || $label !== 'id') {  
            ?>          

                        <div class="campo">
                            <label class="capitalize" for=""><?php echo $label ?>:</label>
                            <input type="text" name="<?php echo $atributos[$i];?>" value="">
                        </div class="campo">
            <?php
                        $i++;
                    }
                }
            ?>


            <input class="boton boton-principal w-100" type="submit" value="Guardar">
        </form>
    </div>
</div>

<script src="js/crud.js"></script>
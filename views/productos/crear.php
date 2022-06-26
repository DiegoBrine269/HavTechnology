<form action="" class="formulario">
    <div class="campo">
        <label for="id">ID (SKU):</label>
        <input type="text" name="id" id="id">
    </div>

    <div class="campo">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre">
    </div>

    <div class="campo">
        <label for="descripcion">Descripción:</label>
        <input type="textarea" name="descripcion" id="descripcion">
    </div>

    <div class="campo">
        <label for="color">Color:</label>
        <input type="text" name="color" id="color">
    </div>

    <div class="campo">
        <label for="lote">Lote:</label>
        <input type="number" min="1" max="999" name="lote" id="lote">
    </div>

    <div class="campo">
        <label for="cantidad">Cantidad:</label>
        <input type="number" min="1" max="9999" name="cantidad" id="cantidad">
    </div>

    
    <div class="campo">
        <label for="proveedor">Proveedor:</label>
        <select name="proveedor" id="proveedor">
            <?php
                //Despliega en el select todos los proveedores que están registrados
                foreach ($proveedores as $proveedor) {
            ?>
                    <option name="idProveedor" value="<?php echo $proveedor->id; ?>"><?php echo $proveedor->nombre; ?></option>
            <?php   
                }
            ?>
        </select>
    </div>

    <div class="campo">
        <input class="boton boton-principal" type="submit" value="Registrar">
    </div>   
</form>
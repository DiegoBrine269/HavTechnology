<form action="" class="formulario" method="POST">
    <div class="campo">
        <label for="id">ID (SKU):</label>
        <input type="text" name="producto[id]" id="id">
    </div>

    <div class="campo">
        <label for="nombre">Nombre:</label>
        <input type="text" name="producto[nombre]" id="nombre">
    </div>

    <div class="campo">
        <label for="descripcion">Descripción:</label>
        <input type="textarea" name="producto[descripcion]" id="descripcion">
    </div>

    <div class="campo">
        <label for="color">Color:</label>
        <input type="text" name="producto[color]" id="color">
    </div>

    <div class="campo">
        <label for="lote">Lote:</label>
        <input type="number" min="1" max="999" name="producto[lote]" id="lote">
    </div>

    <div class="campo">
        <label for="stock">Cantidad:</label>
        <input type="number" min="1" max="9999" name="producto[stock]" id="cantidad">
    </div>

    
    <div class="campo">
        <label for="proveedor">Proveedor:</label>
        <select name="producto[idProveedor]" id="proveedor">
            <?php
                //Despliega en el select todos los proveedores que están registrados
                foreach ($proveedores as $proveedor) {
            ?>
                    <option value="<?php echo $proveedor->id; ?>"><?php echo $proveedor->nombre; ?></option>
            <?php   
                }
            ?>
        </select>
    </div>

    <div class="campo">
        <input class="boton boton-principal" type="submit" value="Registrar">
    </div>   
</form>
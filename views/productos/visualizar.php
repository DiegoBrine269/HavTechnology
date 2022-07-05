

<div class="producto">
    <div class="campo">
        <p class="label">ID</p>
        <p> <?php echo $producto->id ?> </p>
    </div>
    <div class="campo">
        <p class="label">ID único</p>
        <p> <?php echo $productoUnico->idUnico ?> </p>
    </div>
    <div class="campo">
        <p class="label">Nombre</p>
        <p> <?php echo $producto->nombre ?> </p>
    </div>
    <div class="campo">
        <p class="label">Descripción</p>
        <p> <?php echo $producto->descripcion ?> </p>
    </div>
    <div class="campo">
        <p class="label">Color</p>
        <p> <?php echo $producto->color ?> </p>
    </div>
    <div class="campo">
        <p class="label">Lote</p>
        <p> <?php echo $producto->lote ?> </p>
    </div>
    <div class="campo">
        <p class="label">Stock</p>
        <p> <?php echo $productoUnico->existe ?> </p>
    </div>
    <div class="campo">
        <p class="label">Proveedor</p>
        <p> <?php echo $producto->nombreProveedor ?> </p>
    </div>
</div>
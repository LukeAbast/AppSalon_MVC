<div class="campo">
    <label for="nombre">Servicio</label>
    <input
        type="text"
        id="nombre"
        placeholder="Nombre Servicios"
        name="nombre"
        value="<?php echo $servicio->nombre; ?>"
    >
</div>

<div class="campo">
    <label for="precio">Precio</label>
    <input
        type="number"
        id="precio"
        placeholder="Precio Servicios"
        name="precio"
        value="<?php echo $servicio->precio; ?>"
    >
</div>
<h1 class="nombre-pagina">Crea Tu Cita</h1>
<p class="descripcion-pagina">Selecciona los Servicios que Necesites</p>

<?php
    include_once __DIR__ . '/../templates/barra.php';
?>

<div id="app">
    <nav class="tabs">
        <button type="button" data-paso="1" class="actual">Servicios</button>
        <button type="button" data-paso="2">Turno</button>
        <button type="button" data-paso="3">Resumen</button>
    </nav>

    <div id="paso-1" class="seccion">
        <h2>Servicios</h2>
        <p class="text-center">Selecciona los Servicios a continuación</p>
        <div id="servicios" class="listado-servicios"></div>
    </div>

    <div id="paso-2" class="seccion">
        <h2>Turno</h2>
        <p class="text-center">Selecciona un Turno Disponible</p>

        <form class="formulario">
            <div class="campo">
                <label for="nombre">Nombre</label>
                <input
                    type="hidden"
                    id="id"
                    value="<?php echo $id; ?>"
                />
                <input
                    type="text"
                    id="nombre"
                    placeholder="Tu Nombre"
                    value="<?php echo $nombre; ?>"
                    disabled                
                />
            </div>

            <div class="campo">
                <label for="fecha">Fecha</label>
                <input
                    type="date"
                    id="fecha"
                    min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>"               
                />
            </div>

            <div class="campo">
                <label for="hora">Hora</label>
                <input
                    type="time"
                    id="hora"
                    reset="00:00"             
                />
            </div>
            <input type="hidden" id="id" value="<?php echo $id ?>;">
        </form>

    </div>

    <div id="paso-3" class="seccion contenido-resumen">
        <h2>Resumen</h2>
        <h3 class="text-center">Resumen de la Cita</h3>

    </div>

    <div class="paginacion">
        <button
            id="anterior"
            class="boton"
        >&laquo; Anterior</button>

        <button
            id="siguiente"
            class="boton"
        >Siguiente &raquo;</button>
    </div>
</div>


<?php
    $script = "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script src='build/js/app.js'></script>
    ";
?>
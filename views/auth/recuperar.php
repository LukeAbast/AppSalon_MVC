<h1 class="nombre-pagina">Reestablece tu Password</h1>

<?php include_once __DIR__ . '/../templates/alertas.php'; ?>

<?php if($error) return; ?>
<form class="formulario" method="POST">
    <div class="campo">
        <label for="password">Password</label>
        <input
            type="password"
            id="password"
            placeholder="Tu NUEVO Password"
            name="password"        
        />
    </div>

    <input class="boton" type="submit" value="Reestablecer">
</form>

<div class="acciones">
    <a href="/">¿Ya tienes Cuenta? Inicia Sesión</a>
    <a href="/crearCuenta">¿Aún no tienes una cuenta? Registrarse</a>
</div>
<h1 class="nombre-pagina">Recuperar Password</h1>
<p class="descripcion-pagina">Ingresa el Usuario con el que te Registraste</p>

<?php include_once __DIR__ . '/../templates/alertas.php'; ?>

<form class="formulario" method="POST" action="/olvide">
    <div class="campo">
        <label for="email">E-mail</label>
        <input
            type="email"
            id="email"
            placeholder="Tu E-mail"
            name="email"        
        />
    </div>

    <input class="boton" type="submit" value="Enviar Instrucciones">
</form>

<div class="acciones">
    <a href="/">¿Ya tienes una cuenta? Inicia Sesión</a>
    <a href="/crearCuenta">¿Aún no tienes una cuenta? Registrarse</a>
</div>
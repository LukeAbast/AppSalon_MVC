<h1 class="nombre-pagina">Login</h1>
<p class="descripcion-pagina">Inicia Sesion con Tus Datos</p>

<?php include_once __DIR__ . '/../templates/alertas.php'; ?>

<form class="formulario" method="POST" action="/">
    <div class="campo">
        <label for="email">E-mail</label>
        <input
            type="email"
            id="email"
            placeholder="Tu E-mail"
            name="email"
            value="<?php echo $auth->email; ?>"        
        />
    </div>

    <div class="campo">
        <label for="password">Password</label>
        <input
            type="password"
            id="password"
            placeholder="Tu Password"
            name="password"        
        />
    </div>

    <input class="boton" type="submit" value="Iniciar Sesión">
</form>

<div class="acciones">
    <a href="/crearCuenta">¿Aún no tienes una cuenta? Registrarse</a>
    <a href="/olvide">¿Has Olvidado tu Password?</a>
</div>
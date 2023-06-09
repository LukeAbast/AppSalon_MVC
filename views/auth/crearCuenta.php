<h1 class="nombre-pagina">Crear Cuenta</h1>
<p class="descripcion-pagina">Completa el siguiente formulario para Crear una Cuenta</p>

<?php include_once __DIR__ . '/../templates/alertas.php'; ?>

<form class="formulario" method="POST" action="/crearCuenta">
    <div class="campo">
        <label for="nombre">Nombre</label>
        <input
            type="texto"
            id="nombre"
            placeholder="Tu Nombre"
            name="nombre"
            value="<?php echo s($usuario->nombre); ?>"        
        />
    </div>

    <div class="campo">
        <label for="apellido">Apellido</label>
        <input
            type="texto"
            id="apellido"
            placeholder="Tu Apellido"
            name="apellido"
            value="<?php echo s($usuario->apellido); ?>"        
        />
    </div>

    <div class="campo">
        <label for="telefono">Telefono</label>
        <input
            type="tel"
            id="telefono"
            placeholder="Tu Telefono"
            name="telefono"
            value="<?php echo s($usuario->telefono); ?>"        
        />
    </div>
    
    <div class="campo">
        <label for="email">E-mail</label>
        <input
            type="email"
            id="email"
            placeholder="Tu E-mail"
            name="email"
            value="<?php echo s($usuario->email); ?>"        
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

    <input class="boton" type="submit" value="Registrar Cuenta">
</form>

<div class="acciones">
    <a href="/">¿Ya tienes una cuenta? Inicia Sesión</a>
    <a href="/olvide">¿Has Olvidado tu Password?</a>
</div>
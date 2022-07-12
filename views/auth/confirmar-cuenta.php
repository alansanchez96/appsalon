<h1 class="nombre-pagina">Confirmar cuenta</h1>

<?php include_once __DIR__ . '/../templates/alertas.php'; ?>

<form class="formulario" action="/" method="POST">
    
    <p class="descripcion-pagina"">Ingresa a tu cuenta</p>
    <div class="campo">
        <input type="email" placeholder="Ingresa tu correo" name="email">
    </div>
    <div class="campo">
        <input type="password" placeholder="Ingresa tu contraseña" name="password">
    </div>

    <input type="submit" value="Iniciar Sesion" class="boton">
    
</form>

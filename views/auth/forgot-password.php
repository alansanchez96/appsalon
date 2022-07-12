<h1 class="nombre-pagina">Recuperar contraseña</h1>
<p class="descripcion-pagina">Ingresa el correo electronico que deseas recuperar</p>

<?php 
    include_once __DIR__ . '/../templates/alertas.php';
?>

<form action="/forgot-password" class="formulario" method="POST">

    <div class="campo">
        <input type="email" name="email" placeholder="Ingresa tu email">
    </div>

    <input type="submit" value="Enviar" class="boton">
</form>

<div class="acciones">
    <a href="/register">¿Aun no tienes una cuenta? ¡Registrate!</a>
    <a href="/">¿Ya estás registrado? Inicia Sesión</a>
</div>
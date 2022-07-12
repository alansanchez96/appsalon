<h1 class="nombre-pagina">Login</h1>
<p class="descripcion-pagina">Inicia sesión con tus datos</p>

<?php 
    include_once __DIR__ . '/../templates/alertas.php';
?>

<form class="formulario" action="/" method="POST">

    <div class="campo">
        <input type="email" placeholder="Ingresa tu correo" name="email">
    </div>
    <div class="campo">
        <input type="password" placeholder="Ingresa tu contraseña" name="password">
    </div>

    <input type="submit" value="Iniciar Sesion" class="boton">
    
</form>
<div class="acciones">
    <a href="/register">¿Aun no tienes una cuenta? ¡Registrate!</a>
    <a href="/forgot-password">¿Olvidaste tu contraseña?</a>
</div>
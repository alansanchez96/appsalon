<h1 class="nombre-pagina">Crear Cuenta</h1>
<p class="descripcion-pagina">Completa todos los campos</p>

<?php 
    include_once __DIR__ . '/../templates/alertas.php';
?>

<form class="formulario" action="/register" method="POST">

    <div class="campo">
        <input type="text" placeholder="Nombre" name="nombre" value="<?php echo s($usuario->nombre); ?>">
    </div>
    <div class="campo">
        <input type="apellido" placeholder="Apellido" name="apellido" value="<?php echo s($usuario->apellido); ?>">
    </div>
    <div class="campo">
        <input type="tel" placeholder="Telefono" name="telefono" value="<?php echo s($usuario->telefono); ?>">
    </div>
    <div class="campo">
        <input type="email" placeholder="Correo Electronico" name="email" value="<?php echo s($usuario->email); ?>">
    </div>
    <div class="campo">
        <input type="password" placeholder="Contraseña" name="password">
    </div>

    <input type="submit" value="Crear Cuenta" class="boton">
    
</form>
<div class="acciones">
    <a href="/">¿Ya estás registrado? Inicia Sesión</a>
    <a href="/forgot-password">¿Olvidaste tu contraseña?</a>
</div>
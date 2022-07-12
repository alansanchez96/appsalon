<h1 class="nombre-pagina">Restablecer Contraseña</h1>

<?php include_once __DIR__ . '/../templates/alertas.php'; ?>
<?php if($error) return; ?>

<form class="formulario" method="POST">
    
    <p class="descripcion-pagina"">A continuacion coloque su nueva Clave</p>
    <div class="campo">
        <input type="password" placeholder="Ingresa tu contraseña" name="password">
    </div>

    <input type="submit" value="Restablecer" class="boton">
    
</form>

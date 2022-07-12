<?php
    include_once __DIR__ . '/../templates/barra.php';
?>
<div class="back">
    <a href="/servicios" class="btn-back">&laquo; Volver</a>
</div>
<h1 class="nombre-pagina">Actualizar Servicio</h1>
<p class="descripcion-pagina">Llena todos los campos</p>

<?php 
    include_once __DIR__ . '/../templates/alertas.php';
?>


<form class="formulario" method="POST">

    <?php include_once __DIR__ . '/formulario.php'; ?>

    <input type="submit" class="editar" value="Actualizar">
</form>
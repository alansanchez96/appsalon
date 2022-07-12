<?php
    include_once __DIR__ . '/../templates/barra.php';
?>

<h1 class="nombre-pagina">Servicios</h1>
<p class="descripcion-pagina">Administra tus servicios</p>

<?php
    include_once __DIR__ . '/../templates/barra-servicios.php';
?>

<ul class="servicios flex">
    <?php 
    foreach($servicio as $servicio){ ?>
        
        <li>
            <p>Nombre: <span><?php echo $servicio->nombre; ?></span> </p>
            <p>Precio: <span>$ <?php echo $servicio->precio; ?></span> </p>
            <div class="acciones">
                <a href="/servicios/actualizar?id=<?php echo $servicio->id; ?>" class="boton-editar">Editar</a>
                <form action="/servicios/eliminar" method="POST">
                    <input type="hidden" name="id" value="<?php echo $servicio->id; ?>">
                    <input type="submit" class="boton-eliminar" value="Eliminar">
                </form>
            </div>
        </li>
        
    <?php } ?>
</ul>
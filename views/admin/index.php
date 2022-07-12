<?php
    include_once __DIR__ . '/../templates/barra.php';
?>


<h1 class="nombre-pagina">Panel de Administracion</h1>

<?php
    include_once __DIR__ . '/../templates/barra-paginador.php';
?>

<h2>Buscar Cita</h2>

<div class="busqueda">
    <form class="formulario">
        <div class="campo">
            <label for="fecha">Ingresar Fecha</label>
            <input type="date" name="fecha" id="fecha" value="<?php echo $fecha; ?>">
        </div>


    </form>
</div>

<?php 

    if(count($citas) === 0){
        echo "<h3>No hay citas para la fecha seleccionada</h3>";
    }

?>

<div id="citas-admin">
    <ul class="citas">
    <?php
        $citaID = 0;
        foreach ($citas as $key => $cita):
        if($citaID !== $cita->id): 
            $total = 0;
    ?>            
        <li>
            <p>ID: <span><?php echo $cita->id; ?></span></p>
            <p>Hora: <span><?php echo $cita->hora; ?></span></p>
            <p>Cliente: <span><?php echo $cita->Cliente; ?></span></p>
            <p>Email: <span><?php echo $cita->email; ?></span></p>
            <p>Telefono: <span><?php echo $cita->telefono; ?></span></p>
            <div class="tab-servicio">
                <div class="service-title">
                    <p class="titulo">Servicios</p>
                    <p class="titulo_flecha">&laquo;</p>
                </div>
            </div>
    <?php $citaID = $cita->id;
        endif; 
            $total += $cita->precio;
        ?>  
            
            <div class="servicios-detaill">
                <p><?php echo $cita->Servicios; ?></p>
                <p>Precio: <span><?php echo $cita->precio; ?></span></p>
            </div>
            
    <?php 
        $actual = $cita->id;
        $proximo = $citas[$key + 1]->id ?? 0;

        if(esUltimo($actual, $proximo)){ ?>
            <p class="total">Total: <span>$ <?php echo $total; ?></span> </p>
            <form action="/api/eliminar" method="POST">
                <input type="hidden" name="id" value="<?php echo $cita->id; ?>">
                <input type="submit" class="boton-eliminar" value="Eliminar">
            </form>
    <?php }
        endforeach; 
        ?>
    </ul>
</div>

<?php $script = "<script src='build/js/admin.js'></script>"; ?>






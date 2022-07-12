<?php 

    if(isset($_SESSION['admin'])): ?>
        <div class="barra-servicios">
            <a href="/admin" class="boton-citaservicio">Citas</a>
            <a href="/servicios" class="boton-citaservicio">Servicios</a>
            <a href="/servicios/crear" class="boton-servicios">Crear Servicio</a>
        </div>

<?php endif; ?>
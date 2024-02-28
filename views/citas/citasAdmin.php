<?php  
        include_once __DIR__ . "/../templates/cabeceraAdmin.php";
?>

<h3>Buscar Citas Por Fecha</h3>
<div class="busqueda">
    <form class="formulario">
        <div class="campo">
            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="fecha" value="<?php echo $fechaQuery; ?>">
        </div>
    </form>
</div>

<?php if( count($citasServicios) === 0 ){ ?>
        <h3>No Hay Citas para esta Fecha</h3>
<?php    }  ?>
<div id="citas-admin">
    <ul class="citasAdmin">
        <?php
            $idCita = 0;
            foreach( $citasServicios as $key => $CitaServ ) {

                if($idCita !== $CitaServ->ID){
                    $totalPagar = 0;
        ?>
            <li>
                <p>ID: <span><?php echo $CitaServ->ID; ?></span></p>
                <p>Desde: <span><?php echo $CitaServ->Hora; ?></span> Hasta: <span><?php echo $CitaServ->HoraFin; ?></span></p>
                <p>Cliente: <span><?php echo $CitaServ->Cliente; ?></span></p>

                <p>E-Mail: <span><?php echo $CitaServ->Correo; ?></span></p>
                <p>Telefono: <span><?php echo $CitaServ->Telefono; ?></span></p>

                <h3>Servicios</h3>
                
                <?php
                    $idCita = $CitaServ->ID;
                    } //Fin del IF
                ?> 
            </li>
            <li>  
                <p class="servicio"><span><?php echo $CitaServ->Servicio; ?></span> Precio: $<span><?php echo $CitaServ->Precio; ?></span></p>
                    
            </li>
                <?php 
                    $totalPagar += $CitaServ->Precio;
                    $actual = $CitaServ->ID;
                    $proximo = $citasServicios[$key + 1]->ID ?? 0;
                    if(esUltimo($actual, $proximo)) {
                ?>
                    <p class="totalPagar">Total a Pagar: <span><?php echo $totalPagar; ?></span></p>
                        <form id="frmEliminarCita" action="/appsalon_mvc/public/index.php/api/eliminarCita" method="POST">
                            <input type="hidden" name="ID" value="<?php echo $CitaServ->ID; ?>">
                            <input type="submit" id="btnEliminarCita" class="boton-eliminar" value="Cancelar Cita">
                        </form>
                
                <?php
                        
                    } //End del IF para la funcion esUltimo
                } //End foreach
                ?>
    </ul>
</div>

<?php
    $scriptJS = "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script src='/build/js/buscadorFecha.js'></script> 
        <script src='/build/js/menuAdmin.js'></script> 
    ";
?>
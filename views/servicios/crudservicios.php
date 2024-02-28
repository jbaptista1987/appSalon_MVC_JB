<?php  
        include_once __DIR__ . "/../templates/cabeceraAdmin.php";
?>
<h3>Administrador de Servicios</h3>

<div class="contenedor-tabla-usuariosSel">
        <form method="POST" class="frmChequeo"> 
                <table class="usuarios-seleccionados" id="usuariosTable">
                    <thead>
                        <tr>
                            <th style="width: 9%;">Sel</th>
                            <th style="width: 55%;">Servicio</th>
                            <th style="width: 18%;">Precio (Usd $)</th>
                            <th style="width: 18%;">Tiempo (Min)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if( count($ObjServicio) > 0  ){
                                $conteo = 0;
                            foreach ($ObjServicio as $filas):
                                $conteo++;
                        ?>
                        <tr>
                            <td style="text-align: center;">
                                <input type="checkbox" class="chequeo" data-value="<?php echo $filas->ID; ?>" name="cheq-<?php echo $conteo; ?>">
                            </td>
                        
                            <td><?php echo $filas->nombre?></td>
                        
                            <td style="text-align: center;"><?php echo $filas->precio?></td>
                        
                            <td style="text-align: center;"><?php echo $filas->Tiempo?></td>
                        </tr>
                        
                        <?php  endforeach;} ?>
                    </tbody>
                </table>
                        
                <div class="campo-boton2">
                    <input id="btnEliminarS" type="submit" class="boton" value="Eliminar Servicio">
                </div>

                <div class="campo">
                        <label for="nombre">Servicio:</label>
                        <input type="text" name="nombre" id="nombreServicio" onkeypress="return SoloLetras(event);" maxlength="59" placeholder="Servicio" require>
                </div>
                <div class="campo">
                        <label for="precio">Precio:</label>
                        <input type="number" name="precio" id="precioServicio" min=10 onkeypress="return SoloNumeroPunto(event);" maxlength="8" placeholder="Precio (USD $)" require>
                </div>
                <div class="campo">
                        <label for="Tiempo">Tiempo:</label>
                        <input type="number" name="Tiempo" id="tiempoServicio" min=10 onkeypress="return SoloNumero(event);" maxlength="11" placeholder="Tiempo (Min)" require>
                </div>
                <div class="campo-boton2">
                    <input id="btnRegistrarS" type="submit" class="boton" value="Registrar">
                </div>
        </form>
</div>





<?php
    $scriptJS = "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script src='/appsalon_mvc/public/build/js/funciones.js'></script> 
        <script src='/appsalon_mvc/public/build/js/crudServicios.js'></script> 
    ";
?>
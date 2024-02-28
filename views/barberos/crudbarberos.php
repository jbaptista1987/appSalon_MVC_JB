<?php  
        include_once __DIR__ . "/../templates/cabeceraAdmin.php";
?>
<h3>Administrador de Barberos</h3>
<div class="contenedor-tabla-usuariosSel">
        <form method="POST" class="frmChequeo"> 
                <table class="usuarios-seleccionados" id="usuariosTable">
                    <thead>
                        <tr>
                            <th style="width: 10%;">Sel</th>
                            <th style="width: 55%;">Barbero</th>
                            <th style="width: 35%;">Sede</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if( count($ObjBarberos) > 0  ){
                                $conteo = 0;
                            foreach ($ObjBarberos as $filas):
                                $conteo++;
                        ?>
                        <tr>
                            <td style="text-align: center;">
                                <input type="checkbox" class="chequeo" data-value="<?php echo $filas->ID; ?>" name="cheq-<?php echo $conteo; ?>">
                            </td>
                        
                            <td><?php echo $filas->nombre?></td>
                        
                            <td style="text-align: center;">
                                <?php 
                                    if( $filas->sede == '1' ) {
                                        echo 'Sede Principal';
                                    }
                                    else{
                                        echo 'Sede Sucursal';
                                    }
                                    
                                ?>
                            </td>
                        </tr>
                        
                        <?php  endforeach;} ?>
                    </tbody>
                </table>
                        
                <div class="campo-boton2">
                    <input id="btnEliminarB" type="submit" class="boton" value="Eliminar Servicio">
                </div>

                <div class="campo">
                        <label for="nombre">Nombre:</label>
                        <input type="text" name="nombre" id="nombreBarbero" onkeypress="return SoloLetras(event);" maxlength="59" placeholder="Nombre del Barbero" require>
                </div>
                <div class="campo">
                        <label for="sede">Sede:</label>
                        <select id="sedeBarbero" name="sede"> 
                            <option default value="0">--- Seleccionar ---</option>
                            <option default value="1" >Sede Principal</option>
                            <option default value="2" >Sede Sucursal</option>
                        </select>
                </div>
                
                <div class="campo-boton2">
                    <input id="btnRegistrarB" type="submit" class="boton" value="Registrar">
                </div>
        </form>
</div>







<?php
    $scriptJS = "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script src='/appsalon_mvc/public/build/js/funciones.js'></script> 
        <script src='/appsalon_mvc/public/build/js/crudBarberos.js'></script> 
    ";
?>
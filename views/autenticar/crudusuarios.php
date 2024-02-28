<?php  
        include_once __DIR__ . "/../templates/cabeceraAdmin.php";
?>
<h3>Administrador de Usuarios</h3>

<div class="contenedor-tabla-usuariosSel">
    <form method="POST" class="frmChequeo"> 
        <table class="usuarios-seleccionados" id="usuariosTable">
            <thead>
                <tr>
                    <th style="width: 7%;">Sel</th>
                    <th style="width: 35%;">Cliente</th>
                    <th style="width: 26%;">Usuario</th>
                    <th style="width: 15%;">Tipo</th>
                    <th style="width: 17%;">Estatus</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if( count($ObjLogin) > 0  ){
                        $conteo = 0;
                    foreach ($ObjLogin as $filas):
                        $conteo++;
                ?>
                <tr>
                    <td>
                        <input type="checkbox" class="chequeo" data-value="<?php echo $filas->ID; ?>" name="cheq-<?php echo $conteo; ?>">
                    </td>
                    <td><?php echo $filas->Nombre . " " . $filas->Apellido; ?></td>
                    
                    <td>
                        <a href="" class="linkUsuario"><?php echo $filas->Usuario; ?></a>    
                    </td>

                    <td>
                        <?php 
                        if($filas->Tipo_Usuario=='1'){
                            $tipoU = 'Cliente';
                        }else {
                            $tipoU = 'Empleado';
                        }
                        echo $tipoU; 
                        ?>
                    </td>


                    <td>
                        <?php 
                        switch ($filas->Estatus) {
                            case 1:
                                echo "Creado";
                                break;
                            case 2:
                                echo "Activo";
                                break;
                            case 3:
                                echo "Suspendido";
                                break;
                        } 
                        ?>
                        <input type="hidden" class="docUsuario" value="<?php echo $filas->Doc; ?>">
                        <input type="hidden" class="identUsuario" value="<?php echo $filas->Identificacion; ?>">
                        <input type="hidden" class="telefonoUsuario" value="<?php echo $filas->Telefono; ?>">
                        <input type="hidden" class="correoUsuario" value="<?php echo $filas->Correo; ?>">
                    </td>
                </tr>

                <?php  endforeach;} ?>
            </tbody>
        </table>
    <div class="botoneracrudusuarios">
        <button id="pruebasID" type="submit">Admin Usuario</button>
    </div>
</div>

<h3>Registrar Nuevo Usuario</h3>

    <div class="campo">
        <label for="Identificacion">Ident:</label>
        <select id="Doc" name="Doc" placeholder="Seleciona una opción"> 
            <option default value="0">--- Sel ---</option>
            <option default value="V" <?php echo $ObjLogin2->Doc == "V" ? "selected" : ""; ?> >V</option>
            <option default value="E" <?php echo $ObjLogin2->Doc == "E" ? "selected" : ""; ?> >E</option>
        </select>
        <input type="text" name="Identificacion" id="Identificacion" onkeypress="return SoloNumero(event);" maxlength="20" placeholder="Tu cedula o RIF" require value="<?php echo dep( $ObjLogin2->Identificacion ); ?>">
    </div>
    <div class="campo">
        <label for="imagen">Imagen:</label>
        <input type="file" id="Imagen" name="Imagen" accept="image/jpeg, image/png">
    </div>
    <div class="campo">
        <img id="imagePreview" alt="Imagen de Perfil Seleccionada">
    </div>
    <div class="campo">
        <label for="nombre">Nombre:</label>
        <input type="text" name="Nombre" id="nombreR" onkeypress="return SoloLetras(event);" maxlength="49" placeholder="Tu Primer y Segundo Nombre" require value="<?php echo dep( $ObjLogin2->Nombre ); ?>">
    </div>
    <div class="campo">
        <label for="apellido">Apellido:</label>
        <input type="text" name="Apellido" id="apellido" onkeypress="return SoloLetras(event);" maxlength="49" placeholder="Tu Apellido" require value="<?php echo dep( $ObjLogin2->Apellido ); ?>">
    </div>
    <div class="campo">
        <label for="telefono">Telefono:</label>
        <input type="text" name="Telefono" id="telefono" maxlength="12" placeholder="Tu Numero de Telefono" require value="<?php echo dep( $ObjLogin2->Telefono ); ?>">
    </div>
    <div class="campo">
        <label for="correo">Correo:</label>
        <input type="email" name="Correo" id="correo" maxlength="49" placeholder="Tu E-Mail" require value="<?php echo dep( $ObjLogin2->Correo ); ?>">
    </div>

    
    <div class="campo">
        <label for="usuario">Usuario:</label>
        <input type="text" name="Usuario" id="usuario" maxlength="20" placeholder="Nombre de Usuario" require value="<?php echo dep( $ObjLogin2->Usuario ); ?>">
    </div>
    <div class="campo">
        <label for="clave">Clave:</label>
        <input type="password" name="Clave" id="clave" maxlength="60" placeholder="Contraseña" require">
    </div>
    <div class="campo">
        <label for="Tipo_Usuario">Tipo de Usuario:</label>
        <select id="Tipo_Usuario" name="Tipo_Usuario"> 
            <option default value="0">--- Seleccionar ---</option>
            <option default value="1" <?php echo $ObjLogin2->Tipo_Usuario == "1" ? "selected" : "";?> >Cliente</option>
            <option default value="2" <?php echo $ObjLogin2->Tipo_Usuario == "2" ? "selected" : "";?> >Empleado</option>
        </select>
    </div> 


    <div class="campo-boton">
        <input id="btnRegistrarU" type="submit" class="boton" value="Registrar">
    </div>

</div>
</form>

<?php
    $scriptJS = "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script src='/build/js/crudUsuarios.js'></script> 
        <script src='/build/js/funciones.js'></script> 
    ";
?>
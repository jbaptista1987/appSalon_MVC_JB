<h1 class="nombre-pagina">Crear Cuenta</h1>
<p class="descripcion-pagina">Ingrese sus datos de Registro</p>

<form action="/appsalon_mvc/public/index.php/crearcta" class="formulario" method="POST" enctype="multipart/form-data">
    <div class="campo">
        <label for="Identificacion">Ident:</label>
        <select id="Doc" name="Doc" placeholder="Seleciona una opción"> 
            <option default value="0">--- Sel ---</option>
            <option default value="V" <?php echo $ObjLogin->Doc == "V" ? "selected" : ""; ?> >V</option>
            <option default value="E" <?php echo $ObjLogin->Doc == "E" ? "selected" : ""; ?> >E</option>
        </select>
        <input type="text" name="Identificacion" id="Identificacion" onkeypress="return SoloNumero(event);" maxlength="20" placeholder="Tu cedula o RIF" require value="<?php echo dep( $ObjLogin->Identificacion ); ?>">
    </div>
    <div class="campo">
        <label for="nombre">Nombre:</label>
        <input type="text" name="Nombre" id="nombreR" onkeypress="return SoloLetras(event);" maxlength="49" placeholder="Tu Primer y Segundo Nombre" require value="<?php echo dep( $ObjLogin->Nombre ); ?>">
    </div>
    <div class="campo">
        <label for="apellido">Apellido:</label>
        <input type="text" name="Apellido" id="apellido" onkeypress="return SoloLetras(event);" maxlength="49" placeholder="Tu Apellido" require value="<?php echo dep( $ObjLogin->Apellido ); ?>">
    </div>
    <div class="campo">
        <label for="telefono">Telefono:</label>
        <input type="text" name="Telefono" id="telefono" maxlength="12" placeholder="Tu Numero de Telefono" require value="<?php echo dep( $ObjLogin->Telefono ); ?>">
    </div>
    <div class="campo">
        <label for="correo">Correo:</label>
        <input type="email" name="Correo" id="correo" maxlength="49" placeholder="Tu E-Mail" require value="<?php echo dep( $ObjLogin->Correo ); ?>">
    </div>

    
    <div class="campo">
        <label for="usuario">Usuario:</label>
        <input type="text" name="Usuario" id="usuario" maxlength="20" placeholder="Nombre de Usuario" require value="<?php echo dep( $ObjLogin->Usuario ); ?>">
    </div>
    <div class="campo">
        <label for="clave">Clave:</label>
        <input type="password" name="Clave" id="clave" maxlength="60" placeholder="Contraseña" require">
    </div>
    <div class="campo">
        <label for="Tipo_Usuario">Tipo de Usuario:</label>
        <select id="Tipo_Usuario" name="Tipo_Usuario"> 
            <option default value="0">--- Seleccionar ---</option>
            <option default value="1" <?php echo $ObjLogin->Tipo_Usuario == "1" ? "selected" : "";?> >Cliente</option>
            <option default value="2" <?php echo $ObjLogin->Tipo_Usuario == "2" ? "selected" : "";?> >Empleado</option>
        </select>
    </div>
    <div class="errorLlenado msjExito" id="divMensaje"></div>  

    <?php  
        include_once __DIR__ . "/../templates/alertas.php";
    ?>
    
    <div class="campo-boton">
        <input type="submit" class="boton" value="Registrar">
    </div>

</form>

<div class="acciones">
    <a href="/">Inicio de Sesion</a>
    <a href="/olvidarpass">¿Olvidaste tus Datos de Acceso?</a>
</div>


<?php
    $scriptJS = "
        <script src='/build/js/app.js'></script>  
    ";
?>
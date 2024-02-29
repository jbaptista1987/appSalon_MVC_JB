
<h1 class="nombre-pagina">Inicio de Sesion</h1>
<p class="descripcion-pagina">Ingrese los datos asociados a su cuenta</p>

<form id=formLogin class="formulario" method="post">
    <div class="campo">
        <label for="usuario">Usuario:</label>
        <input type="text" name="Usuario" id="usuario" placeholder="Nombre de Usuario" require>
    </div>
    <div class="campo">
        <label for="clave">Clave:</label>
        <input type="password" name="Clave" id="clave" placeholder="Contraseña" require>
    </div>

    <div class="campo">
        <div class="g-recaptcha" data-sitekey="6LdWX2gpAAAAAPMo57eRyAn3-QmLPkl2YvywRN_F">
        </div>
    </div>

    <?php  
        include_once __DIR__ . "/../templates/alertas.php";
    ?>
    
    <div class="campo-boton">
        <input type="submit" class="boton" value="Log In"> 
    </div>       
</form>

<div class="acciones">
    <a href="/crearcta">Registrarse AQUI...</a>
    <a href="/olvidarpass">¿Olvidaste tus Datos de Acceso?</a>
</div>


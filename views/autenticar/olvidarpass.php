<h1 class="nombre-pagina">Olvidaste tu Clave?</h1>
<p class="descripcion-pagina">Restablecela escribiendo tu E-Mail</p>

<form  class="formulario" method="post">
    <div class="campo">
        <label for="correo">Correo:</label>
        <input type="email" name="Correo" id="correo" placeholder="Tu E-Mail" require>
    </div>

    <?php  
        include_once __DIR__ . "/../templates/alertas.php";
    ?>
    
    <div class="campo-boton">
        <input type="submit" class="boton" value="Recuperar">
    </div>
</form>

<div class="acciones">
    <a href="/">Inicio de Sesion</a>
    <a href="/crearcta">Registrate Aqui...</a>
</div>
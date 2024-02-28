<h1 class="nombre-pagina">Recuperar Clave</h1>
<p class="descripcion-pagina">Ingresa tu Nueva Clave</p>

<form action="" class="formulario" method="post">
    
    <div class="campo">
        <label for="clave">Clave:</label>
        <input type="password" name="Clave" id="clave" placeholder="Contraseña" required>
    </div>

    <?php  
        include_once __DIR__ . "/../templates/alertas.php";
    ?>
    
    <div class="campo-boton">
        <input type="submit" class="boton" value="Registrar"> 
    </div>       

</form>
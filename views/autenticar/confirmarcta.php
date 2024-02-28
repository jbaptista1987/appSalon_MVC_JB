<div style="height: 100%; display: flex; align-items:center; justify-content: center;">
    <div style="height: 40%; width: 40%; display: flex; flex-direction: column; align-items:center; justify-content: center;">
        <?php
            if ($nuevoUsuarioEstatus == 2) {
                echo "<p>Registro Confirmado</p>";
            }else{
                echo "<p>Registro de Cuenta Empleado Confirmada - Esperar a que la Gerencia la Apruebe</p>";
            }
        ?>
        
        <p>Sera Redigiridigo en: </p>
        <div id="countdown">10</div>

        <img src="/AppSalon_MVC/public/build/img/loadingapp.gif" alt="Icono Loading" loading="lazy">
    </div>
</div>


<?php
    $scriptJS = "
        <script src='/appsalon_mvc/public/build/js/app.js'></script>  
    ";
?>
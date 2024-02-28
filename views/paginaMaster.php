<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>App Salón</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;700;900&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="/appsalon_mvc/public/build/css/app.css">

    <!-- Para el Recaptcha de Google -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script
	  src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
	  integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8="
	  crossorigin="anonymous"></script>
</head>
<body>
    <div class="contenedor-app">
         <div class="imagen"></div> <!-- Aqui ira la imagen principal, se pondra con css -->
        <div class="app"> <!-- Aqui va el contenido de cada pagina -->
            
                
            <?php 

                if( isset( $_SESSION["Tipo_Usuario"] ) && $_SESSION["Tipo_Usuario"] == "3"   ) { 
            ?>
            <div class="barra">
                <div class="mobile-menu">
                    <img src="/appsalon_mvc/public/build/img/barras.svg" alt="Icono de Menu">
                </div>

                <nav class="navegacion">
                        <a href="/appsalon_mvc/public/index.php/admin">Consultar Citas</a>
                        <a href="/appsalon_mvc/public/index.php/citasIndex">Crear Cita</a>
                        <a href="/appsalon_mvc/public/index.php/crudusuarios">CRUD Usuarios</a>
                        <a href="/appsalon_mvc/public/index.php/crudservicios">CRUD Servicios</a>
                        <a href="/appsalon_mvc/public/index.php/crudbarberos">CRUD Barberos</a>
                </nav>
            </div> 
            <?php    
                }
                echo $contenido; 
            ?>
        </div>
    </div>
    
    
    <?php
        echo $scriptJS ?? '';  
    ?>

    <?php 

        if( isset( $_SESSION["Tipo_Usuario"] ) && $_SESSION["Tipo_Usuario"] == "3"   ) {
    ?>
        <script src='/appsalon_mvc/public/build/js/menuAdmin.js'></script> 
    <?php } ?>


</body>
</html>
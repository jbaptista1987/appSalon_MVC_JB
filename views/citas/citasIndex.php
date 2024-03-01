<h1 class="nombre-pagina">Crear Nueva Cita</h1>
<p class="descripcion-pagina">Elige Servicios y Escribe tus Datos</p>

<div class="barraLog">
    <div>
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-scissors" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
          <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
          <path d="M14 3v4a1 1 0 0 0 1 1h4" />
          <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
          <path d="M15 17m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
          <path d="M9 17m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
          <path d="M9 17l6 -6" />
          <path d="M15 17l-6 -6" />
        </svg>
    </div>
    <div id="identUsuarioPanel">
        <p> <?php echo $nombre ?> </p>
    </div>
    <a id="cerrarSesion" class="cerrar-sesion-btn" href="/logout">Cerrar sesión</a>
</div>

<div id="app">

    <div class="tabs">
        <button class="actual" type="button" data-paso="1">Servicios</button>
        <button class="" type="button" data-paso="2">Informacion Cita</button>
        <button class="" type="button" data-paso="3">Resumen</button>
    </div>

    <div id="paso-1" class="seccion">
        <h2>Servicios</h2>
        <p class="text-center">Elige tus servicios a continuacion</p>
        <div id="servicios" class="listado-servicios"></div>
    </div>

    <div id="paso-2" class="seccion">
        <h2>Datos y Cita</h2>
        <p class="text-center">Tus Datos Personales y Fecha de Cita</p>

        <form class="formulario">
            <div class="campo">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" onkeypress="return SoloLetras(event);" maxlength="49" placeholder="Tu Primer y Segundo Nombre" value="<?php echo $nombre ?>" readonly>
            </div>
            <div class="campo">
                <label for="fecha">Fecha:</label>
                <input type="date" name="fecha" id="fecha" maxlength="10" placeholder="Fecha de la Cita" min="<?php echo date('Y-m-d');?>" max="<?php echo date('Y-m-d', strtotime('+7 days')); ?>" value="<?php echo date('Y-m-d');?>">
            </div>
            <div class="campo">
                <label for="hora">Hora:</label>
                <input type="time" name="hora" id="hora" maxlength="9" placeholder="Hora de la Cita">
            </div>
            <div class="campo">
                <label for="Barbero">Empleado:</label>
                <select id="Barbero" name="Barbero" placeholder="Selecionar">
                </select>
            </div>
            <input type="hidden" id="clienteID" value="<?php echo $_SESSION['ID'] ?>">
        </form>
    </div>
    <div id="paso-3" class="seccion contenido-resumen">
        <h2>Resumen</h2>
        <p class="text-center">Verifica que toda la informacion este correcta</p>
    </div>

    <div class="paginacion">
        <button class="boton" id="anterior">&laquo; Anterior</button>
        <button class="boton" id="siguiente">Siguiente &raquo;</button>
    </div>
</div>

<?php
    $scriptJS = "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script src='https://unpkg.com/axios/dist/axios.min.js'></script>
        <script src='/build/js/app.js'></script>

    ";
?>
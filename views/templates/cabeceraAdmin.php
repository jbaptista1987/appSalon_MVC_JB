<h1 class="nombre-pagina">Admin de APP Salon</h1>

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
    <a id="cerrarSesion" class="cerrar-sesion-btn" href="/appsalon_mvc/public/index.php/logout">Cerrar sesión</a>
</div>
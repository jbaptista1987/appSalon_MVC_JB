document.addEventListener('DOMContentLoaded', function() {
    clickMenuAdmin();
});

function clickMenuAdmin(){
    const mobileMenu = document.querySelector('.mobile-menu');
    mobileMenu.addEventListener('click', despliegueMenu);
}
function despliegueMenu(){
    const navegacion = document.querySelector('.navegacion');
    navegacion.classList.toggle('mostrar_Menu');
}
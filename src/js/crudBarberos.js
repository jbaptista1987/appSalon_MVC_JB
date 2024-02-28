let usuarioIDsString = '';
let Validador = {};
let regBarbero = {
    nombre: '',
    sede: ''
};

document.addEventListener('DOMContentLoaded', function() {
   
    selBarberosID();
    validarFrmRegBarberos();
    
});
function selBarberosID(){
    const mobileMenu = document.querySelector('#btnEliminarB');
    mobileMenu.addEventListener('click', e => {
    e.preventDefault();
         // CAPTURAR LOS VALORES DE LOS CHECKBOX SELECCIONADOS
         const checkboxes = document.querySelectorAll('input[type="checkbox"]');
         const selectedInputFields = [];
 
         checkboxes.forEach((checkbox) => {
           if (checkbox.checked) {
             // Obtén el atributo data-value del checkbox seleccionado
             const dataValue = checkbox.getAttribute('data-value');
             selectedInputFields.push(dataValue);
           }
         });
 
         // Concatenate the selected checkboxes IDs with single quotes and a comma-separated string
         usuarioIDsString = "('" + selectedInputFields.join("','") + "')";
         //console.log(usuarioIDsString);
         delBarberoSel();
    }); //Cierre del Event Listener de presionar el boton de Eliminar Servicios
}
async function delBarberoSel(){
    try {
        const datos = new FormData();
        
        datos.append('IDs', usuarioIDsString);
        datos.append('accion', 'eliminar');
        
        const URL = '/appsalon_mvc/public/index.php/crudbarberos';
        const respuesta = await fetch(URL, {
          method: 'POST',
          body: datos
        });
        const IDs = await respuesta.json();
        //console.log(IDs);
        window.location.reload();
      } catch (error) {
        console.log(error);
      }
}



function validarFrmRegBarberos() {
    const btnRegistrar = document.querySelector('#btnRegistrarB')
    btnRegistrar.addEventListener("click", function (event) {
    event.preventDefault();
    
    Validador.error = [];

    let dataNombre = document.querySelector('#nombreBarbero').value;
    regBarbero.nombre = dataNombre;
    if( dataNombre.trim() == '' ){
      Validador.error.push('* El Nombre del Barbero es Requerido');
    }

    let dataSede = document.querySelector('#sedeBarbero').value;
    regBarbero.sede = dataSede;
    if( dataSede == '0' ){
      Validador.error.push('* La Sede es Requerida');
    }

    if(Validador.error.length === 0){
        //Pasa Validacion y Procedemos a Enviar datos al Back End (Alla los Sanitizo) 
        registrarBarberosCRUD();

    } else{
        console.log(Validador.error);
        const errorMessages = Validador.error.join('<br>');
        Swal.fire({
          icon: 'error',
          title: 'Validacion de Formulario',
          html: '<div class="swalmodalerror">' + errorMessages + '</div>'
        });
    }

    }); //Cierre del Event Listener de presionar el boton de Registrar Barbero 
}
async function registrarBarberosCRUD(){
    const {nombre, sede} = regBarbero;

    try{
        const datos = new FormData();
    
        datos.append('nombre', nombre);
        datos.append('sede', sede);
        datos.append('accion', 'crear');

        const URL = '/appsalon_mvc/public/index.php/crudbarberos';
        const respuesta = await fetch(URL, {
          method: 'POST',
          body: datos
        });
        const resultado = await respuesta.json();
        //console.log(resultado);
        window.location.reload();
    } catch (error) {
        console.log(error);
    }
}
let usuarioIDsString = '';
let Validador = {};
let regServicio = {
    nombre: '',
    precio: '',
    Tiempo: ''
};

document.addEventListener('DOMContentLoaded', function() {
   
    selServiciosID();
    validarFrmRegServicio();
    
});

function selServiciosID(){
    const mobileMenu = document.querySelector('#btnEliminarS');
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
         delServiciosSel();
    }); //Cierre del Event Listener de presionar el boton de Eliminar Servicios
}
async function delServiciosSel(){
    try {
        const datos = new FormData();
        
        datos.append('IDs', usuarioIDsString);
        datos.append('accion', 'eliminar');
        
        const URL = '/crudservicios';
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

function validarFrmRegServicio() {
    const btnRegistrar = document.querySelector('#btnRegistrarS')
    btnRegistrar.addEventListener("click", function (event) {
    event.preventDefault();
    
    Validador.error = [];

    let dataServicio = document.querySelector('#nombreServicio').value;
    regServicio.nombre = dataServicio;
    if( dataServicio.trim() == '' ){
      Validador.error.push('* El Nombre del Servicio es Requerido');
    }

    let dataPrecio= document.querySelector('#precioServicio').value;
    regServicio.precio = dataPrecio;
    if( dataPrecio.trim() == '' ){
      Validador.error.push('* El Precio es Requerido');
    }

    let dataTiempo= document.querySelector('#tiempoServicio').value;
    regServicio.Tiempo = dataTiempo;
    if( dataTiempo.trim() == '' ){
      Validador.error.push('* El Tiempo es Requerido');
    }

    if(Validador.error.length === 0){
        //Pasa Validacion y Procedemos a Enviar datos al Back End (Alla los Sanitizo) 
        registrarServicioCRUD();

    } else{
        console.log(Validador.error);
        const errorMessages = Validador.error.join('<br>');
        Swal.fire({
          icon: 'error',
          title: 'Validacion de Formulario',
          html: '<div class="swalmodalerror">' + errorMessages + '</div>'
        });
    }

    }); //Cierre del Event Listener de presionar el boton de Registrar Servicio 
}
async function registrarServicioCRUD(){
    const {nombre,precio,Tiempo} = regServicio;

    try{
        const datos = new FormData();
    
        datos.append('nombre', nombre);
        datos.append('precio', precio);
        datos.append('Tiempo', Tiempo);
        datos.append('accion', 'crear');

        const URL = '/crudservicios';
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
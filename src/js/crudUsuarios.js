let accion = '';
let nuevoEstatus = '';
let usuarioIDsString = '';
let Cliente = {
  ID: '',
  Usuario: '',
  Doc: '',
  Identificacion: '',
  Nombre: '',
  Correo: '',
  Telefono: '',
  Tipo_Usuario: '',
  Estatus: ''
}
let Validador = {};
let regUsuario = {
  Doc: '',
  Identificacion: '',
  Nombre: '',
  Apellido: '',
  Correo: '',
  Telefono: '',
  Usuario: '',
  Clave: '',
  Tipo_Usuario: '',
  Estatus: '2'
}

document.addEventListener('DOMContentLoaded', function() {
    delUsuarios();
    displayUsuario();
    
    mostrarIMGprevia();
    validarFrmRegUsuario();
});



function delUsuarios(){
  const mobileMenu = document.querySelector('#pruebasID');
  mobileMenu.addEventListener('click', e => {
    e.preventDefault();

    (async () => {
      const { value: AccionSWAL } = await Swal.fire({
        title: "Que Desea Hacer?",
        input: "select",
        inputOptions: {
          2: "Aprobar / Activar Usuario",
          3: "Suspender Usuario"
        },
        inputPlaceholder: "Seleccionar una Opcion",
        showCancelButton: true,
      });

      const swalModal = document.querySelector('.swal2-popup');
      swalModal.addEventListener('click', (event) => {
        if (event.target.innerText === 'OK') {
          nuevoEstatus = AccionSWAL;

          // Capture the values of the checkboxes and input fields
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

        /*console.log('Enviaremos al Back....');
        console.log(accion);
        console.log(usuarioIDsString);*/
        delUsuariosSel();

        }
      });
    })() //Cierre del SWAL

  }); //Cierre del Event Listener de presionar el boton de Usuarios Admin
}
async function delUsuariosSel(){
    try {
        const datos = new FormData();
        
        datos.append('IDs', usuarioIDsString);
        datos.append('estatus', nuevoEstatus);
        datos.append('accion', 'modificar');
        
        const URL = '/crudusuarios';
        const respuesta = await fetch(URL, {
          method: 'POST',
          body: datos
        });
        const IDs = await respuesta.json();
        console.log(IDs);
        window.location.reload();
      } catch (error) {
        console.log(error);
      }
}

function displayUsuario(){
  document.querySelectorAll("tbody .linkUsuario").forEach((link) => {
    link.addEventListener("click", function (event) {
      event.preventDefault();

      let fila1 = this.closest("tr");
      let checkbox = fila1.querySelector("td:first-child input[type='checkbox']");
      Cliente.ID = checkbox.dataset.value; //ID

      let fila2 = this.closest("tr");
      let hidden2 = fila2.querySelector("input.docUsuario");
      Cliente.Doc = hidden2.value; //Doc (V - E)

      let fila3 = this.closest("tr");
      let hidden3 = fila3.querySelector("input.identUsuario");
      Cliente.Identificacion = hidden3.value; //Identificacion (numero de cedula o rif)

      let fila4 = this.closest("tr");
      let hidden4 = fila4.querySelector("input.telefonoUsuario");
      Cliente.Telefono = hidden4.value; //Telefono

      let fila5 = this.closest("tr");
      let hidden5 = fila5.querySelector("input.correoUsuario");
      Cliente.Correo = hidden5.value; //Correo

      var fila6 = this.closest("tr");
      Cliente.Nombre = fila6.querySelector("td:nth-child(2)").innerText; //Nombre y Apellido del Cliente

      var fila7 = this.closest("tr");
      Cliente.Usuario = fila7.querySelector("td:nth-child(3)").innerText; //Usuario

      var fila8 = this.closest("tr");
      Cliente.Tipo_Usuario = fila8.querySelector("td:nth-child(4)").innerText; //Tipo_Usuario

      var fila8 = this.closest("tr");
      Cliente.Estatus = fila8.querySelector("td:nth-child(5)").innerText; //Estatus

      console.log(Cliente);

      //Armar un array y alli meter todos los valores, es mas facil y aplico la POO
      ventanaUsuario();
    });
  });
}
async function ventanaUsuario(){
  const { value: formValues } = await Swal.fire({
    title: "Ficha del Cliente",
    html: `
      <div class="swalModal">
      <strong>ID:</strong> ${Cliente.ID} <br>

      <strong>Usuario:</strong> ${Cliente.Usuario} <br>

      <strong>Ident:</strong> ${Cliente.Doc}-${Cliente.Identificacion} <br>

      <strong>Cliente:</strong> ${Cliente.Nombre} <br>

      <strong>Telefono:</strong> ${Cliente.Telefono} <br>

      <strong>Correo:</strong> ${Cliente.Correo} <br>

      <strong>Tipo:</strong> ${Cliente.Tipo_Usuario} <br>

      <strong>Estatus:</strong> ${Cliente.Estatus}
      </div>
    `,
    customClass: {
      container: 'swal-container-large-font'
    },
    focusConfirm: false,
    width: 'auto'
  });
}

function mostrarIMGprevia(){
  const imageInput = document.getElementById('Imagen');
  const imagePreview = document.getElementById('imagePreview');

  imageInput.addEventListener('change', () => {
    const file = imageInput.files[0];
    const reader = new FileReader();

    reader.onload = (event) => {
      imagePreview.src = event.target.result;
    };

    reader.readAsDataURL(file);
  });
}

function validarFrmRegUsuario(){
  const btnRegistrar = document.querySelector('#btnRegistrarU')
  btnRegistrar.addEventListener("click", function (event) {
    event.preventDefault();
    
    Validador.error = [];

    let dataDoc = document.querySelector('#Doc').value;
    regUsuario.Doc = dataDoc;
    if(dataDoc == '0'){
      Validador.error.push('* El Doc es Requerido');
    }

    let dataIdent = document.querySelector('#Identificacion').value;
    regUsuario.Identificacion = dataIdent;
    if(dataIdent.trim() == ''){
      Validador.error.push('* CI es Requerida');
    }

    let dataNombre = document.querySelector('#nombreR').value;
    regUsuario.Nombre = dataNombre;
    if(dataNombre.trim() == ''){
      Validador.error.push('* El Nombre es Requerido');
    }

    let dataApellido = document.querySelector('#apellido').value;
    regUsuario.Apellido = dataApellido;
    if(dataApellido.trim() == ''){
      Validador.error.push('* El Apellido es Requerido');
    }

    let dataTelefono = document.querySelector('#telefono').value;
    regUsuario.Telefono = dataTelefono;
    if(dataTelefono.trim() == '' || !validarTelefono(dataTelefono)){
      Validador.error.push('* Telefono es Requerido y con Formato XXXX-XXXXXXX');
    }

    let dataCorreo = document.querySelector('#correo').value;
    regUsuario.Correo = dataCorreo;
    if(dataCorreo.trim() == '' || !validarEmail(dataCorreo)){
      Validador.error.push('* Correo en formato Valido es Requerido');
    }

    let dataUsuario = document.querySelector('#usuario').value;
    regUsuario.Usuario = dataUsuario;
    if(dataUsuario.trim() == ''){
      Validador.error.push('* El Usuario es Requerido');
    }

    let dataClave = document.querySelector('#clave').value;
    regUsuario.Clave = dataClave;
    if(dataClave.match(/\s/) || dataClave.length===0){
      Validador.error.push('* La Clave es Requerida');
    }

    let dataTipoUsuario = document.querySelector('#Tipo_Usuario').value;
    regUsuario.Tipo_Usuario = dataTipoUsuario;
    if(dataTipoUsuario == '0'){
      Validador.error.push('* El Tipo de Usuario es Requerido');
    }
    

    if(Validador.error.length === 0){
      //console.log('Pasaste La Validacion');
      //Enviar los datos al Back End por medio de FETCH API - Metodo GET - Accion Registrar
      registrarUsuarioCRUD();
    } else{
      console.log(Validador.error);
      const errorMessages = Validador.error.join('<br>');
      Swal.fire({
        icon: 'error',
        title: 'Validacion de Formulario',
        html: '<div class="swalmodalerror">' + errorMessages + '</div>'
        //footer: '<a href="#">Why do I have this issue?</a>'
      });
    }
  });
}
async function registrarUsuarioCRUD(){
  const {Doc,Identificacion, Nombre,Apellido,Correo,Telefono,Usuario,Clave,Tipo_Usuario,Estatus} = regUsuario;
  
  try {
    const datos = new FormData();
    
    datos.append('Doc', Doc);
    datos.append('Identificacion', Identificacion);
    datos.append('Nombre', Nombre);
    datos.append('Apellido', Apellido);
    datos.append('Correo', Correo);
    datos.append('Telefono', Telefono);
    datos.append('Usuario', Usuario);
    datos.append('Clave', Clave);
    datos.append('Tipo_Usuario', Tipo_Usuario);
    datos.append('Estatus', Estatus);
    datos.append('accion', 'crear');
    
    const URL = '/crudusuarios';
    const respuesta = await fetch(URL, {
      method: 'POST',
      body: datos
    });
    const resultado = await respuesta.json();
    //Validar que el Usuario no este en uso
    if( resultado.ErrorU ){    
      Validador.error = [];
      Validador.error = resultado.ErrorU;
      Swal.fire({
        icon: 'error',
        title: 'Validacion de Formulario',
        html: '<div class="swalmodalerror">' + Validador.error + '</div>'
      });

    }
    if( resultado.ErrorC ){    
      Validador.error = [];
      Validador.error = resultado.ErrorC;
      Swal.fire({
        icon: 'error',
        title: 'Validacion de Formulario',
        html: '<div class="swalmodalerror">' + Validador.error + '</div>'
      });
    }
    console.log(resultado);
    window.location.reload();

    /*Log the response headers and body to the console
    console.log('Response headers:', respuesta.headers);
    const resultado = await respuesta.text();
    console.log('Response body:', resultado);

    const data = JSON.parse(resultado);
    console.log('Data:', data);*/
  } catch (error) {
    console.log(error);
  }
}

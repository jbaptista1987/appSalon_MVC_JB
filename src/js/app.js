let paso = 1;
const pasoMin = 1;
const pasoMax = 3;
const btnSiguiente = document.querySelector('#siguiente');
const btnAnterior = document.querySelector('#anterior');
const alerta = document.createElement('DIV');
const inputFecha = document.querySelector('#fecha');
let tiempoTotal = 0;
let horaFinal = '';
let fechaFormat = '';
let TasaCambio = 0;

let cita = {
  clienteID: '',
  nombre: '',
  fecha: '',
  hora: '',
  empleadoID: '',
  servicios: []
}

document.addEventListener('DOMContentLoaded', function(){

  //API Asincrona para obtener el valor del cambio BCV en tiempo real - Puedo obtener el valor de otras monedas tambien
  fetch('https://api.exchangerate-api.com/v4/latest/USD')
  .then(response => response.json())
  .then(data => {
    TasaCambio = data.rates.VES;
  })
  .catch(error => console.error('Error:', error));


  if(document.querySelector('#paso-1')) {
    cita.fecha = inputFecha.value;
    inciarApp();
  }
  
  
  if(document.querySelector('#Tipo_Usuario')) {
    //Le advierte al Usuario tipo empleado que su registro pasara a aprobacion de la Gerencia
    const selectElement = document.getElementById("Tipo_Usuario");
    const messageDiv = document.getElementById("divMensaje");
    
    selectElement.addEventListener("change", () => {
        if (selectElement.value == "2") {
            divMensaje.innerText = "Tu Solicitud debera ser Aprobada por la Gerencia";
        } else {
            messageDiv.innerText = "";
        }
    });
  }

  if(document.querySelector('#countdown')) {
    const countdownEl = document.getElementById('countdown');
    const targetURL = '/';
    const intervalId = setInterval(() => {
        const currentCount = parseInt(countdownEl.textContent);
        if (currentCount <= 1) {
            clearInterval(intervalId);
            window.location = targetURL;
            return;
        }
        countdownEl.textContent = currentCount - 1;
    }, 1000);
  }
     
});

//FUNCIONES PARA QUE FUNCIONE EL PAGINADOR DE LA PAGINA CITASINDEX
function inciarApp(){

  mostrarSeccion(); // Muestra y Oculta las secciones
  tabs(); //Cambia la seccion cuando se presionan los botones
  botonesPaginador(); // Siguiente o Atras
  paginaSiguiente();
  paginaAnterior();

  consultarAPI(); //Buscar en el Backend de PHP
  clienteID();
  nombreCliente();
  seleccionarBarbero();
  seleccionarFecha();
  seleccionarHora();

  mostrarResumenCita();
}
function tabs(){
  const botones = document.querySelectorAll('.tabs button');

  botones.forEach( boton => {
    boton.addEventListener('click', function(e) {
        paso = parseInt( e.target.dataset.paso );
        mostrarSeccion();
        botonesPaginador();
    });
  });
}
function mostrarSeccion(){
  //Ocultar la seccion que tenga la clase de mostrar
  const seccionAnterior = document.querySelector('.mostrar');
  if( seccionAnterior ){
    seccionAnterior.classList.remove('mostrar');
  }
  
  const seccion = document.querySelector(`#paso-${paso}`);
  seccion.classList.add('mostrar');

  //Quitar el Tab Actual a las demas
  const tabAnterior = document.querySelector('.actual');
  if( tabAnterior ) {
    tabAnterior.classList.remove('actual');
  }

  //Resalta el Tab Actual
  const tab = document.querySelector(`[data-paso="${paso}"]`);
  tab.classList.add('actual');
}
function botonesPaginador(){
  const { servicios } = cita;
  if( paso === 1 ) {
      btnAnterior.classList.add('ocultarbtn');
      btnSiguiente.classList.remove('ocultarbtn');  
  }
  if( paso === 3 ){
      btnAnterior.classList.remove('ocultarbtn');
      btnSiguiente.classList.add('ocultarbtn');
      mostrarResumenCita();
  }
  if( paso === 2 ){
    btnAnterior.classList.remove('ocultarbtn');
    btnSiguiente.classList.remove('ocultarbtn');
    tiempoTotal = servicios.reduce((tiempoTotal, tiempo) => tiempoTotal + parseFloat(tiempo.Tiempo), 0);
  }

  mostrarSeccion();
}
function paginaAnterior(){
  btnAnterior.addEventListener('click', function(){
    if( paso <= pasoMin ) return;
    paso--;
    botonesPaginador();
    
  }); 
}
function paginaSiguiente(){
  btnSiguiente.addEventListener('click', function(){
    if( paso >= pasoMax ) return;
    paso++;
    botonesPaginador();
  }); 
}

//Se usa async para que sea asincrona - No sabemos cuanto demorara y puede afectar la carga de ptras funciones
async function consultarAPI() {
    try {
      const URL = '/appsalon_mvc/public/index.php/api/servicios';
      const resultado = await fetch(URL);
      const servicios = await resultado.json();
      mostrarServicios(servicios);
      
    } catch (error) {
      console.log(error);
    }
}
function mostrarServicios(servicios) {
  
  servicios.forEach( servicio => {
    const {ID, nombre, precio, Tiempo} = servicio;
    
    const nombreServicio = document.createElement('P');
    nombreServicio.classList.add('nombre-servicio');
    nombreServicio.textContent = nombre;

    const precioServicio = document.createElement('P');
    precioServicio.classList.add('precio-servicio');
    precioServicio.textContent = "$ " + precio;

    const tiempoServicio = document.createElement('P');
    tiempoServicio.classList.add('nombre-servicio');
    tiempoServicio.textContent = "Tiempo: " + Tiempo + " Min";

    const servicioDiv = document.createElement('DIV');
    servicioDiv.classList.add('servicio');
    servicioDiv.dataset.idServicio = ID;
    servicioDiv.onclick = function() {
      seleccionarServicio(servicio);
    }
    

    servicioDiv.appendChild(nombreServicio);
    servicioDiv.appendChild(precioServicio);
    servicioDiv.appendChild(tiempoServicio);

    document.querySelector('#servicios').appendChild(servicioDiv);
  });

}
function seleccionarServicio(servicio){
  const { ID } = servicio;
  const { servicios } = cita;

  const divServicioSel = document.querySelector(`[data-id-servicio="${ID}"]`);
  if( servicios.some( agregado => agregado.ID === ID) ) {
    //Eliminarlo
    cita.servicios = servicios.filter( agregado => agregado.ID !== ID );
  } else{
    //agregarlo
    cita.servicios = [...servicios, servicio];
  }
  divServicioSel.classList.toggle('seleccionado');
}
function clienteID(){
  const clienteID = document.querySelector('#clienteID').value;
  cita.clienteID = clienteID;
}
function nombreCliente(){
  const nombre = document.querySelector('#nombre').value;
  cita.nombre = nombre;
}
function seleccionarBarbero() {
  const inputBarbero = document.querySelector('#Barbero');
  inputBarbero.addEventListener("change", function() {
    if(this.value > 0) {
      cita.empleadoID = this.value;
    }
  });
}
function seleccionarFecha(){
    inputFecha.addEventListener('input', function(e){
      const dia = new Date(e.target.value).getUTCDay();
      if( [0, 1].includes(dia) ){
        e.target.value = '';
        mostrarAlerta('Domingo y Lunes No Laboramos','error', '.formulario');
      } else{
        cita.fecha = e.target.value;
      }

    });
}
function seleccionarHora() {
  const { nombre, fecha, hora, horaFin, servicios } = cita;
  const inputHora = document.querySelector('#hora');
  inputHora.addEventListener('input', function(e){

    let horaCita = e.target.value;
    let soloHora = horaCita.split(":")[0];
    
    if( soloHora < 8 || soloHora > 17) {
      e.target.value = '';
      mostrarAlerta('Hora No Valida','error', '.formulario');
    }else{
      cita.hora = e.target.value;

      horaFinal = sumarMinutos(cita.hora, tiempoTotal);
      cita.horaFin = horaFinal;
      //console.log(cita);

      // Validar que el Barbero en esa fecha y a esa hora no este ocupado.
      consultarBarberos(); // Quien atendera al cliente
    }

  });
}
function mostrarAlerta(msj, tipo, elemento, desaparece = true){
  const alertaPrevia = document.querySelector('.error');
  if(alertaPrevia) {
    alertaPrevia.remove();
  }

  alerta.textContent = msj;
  alerta.classList.add('errorLlenado');
  alerta.classList.add(tipo);

  const referencia = document.querySelector(elemento);
  referencia.appendChild(alerta);

  if(desaparece) {
    setTimeout( () => {
      alerta.remove();
    }, 2000);
  }
  
}

function mostrarResumenCita(){
  const resumen = document.querySelector('.contenido-resumen');

  while(resumen.firstChild){
    resumen.removeChild(resumen.firstChild);
  }
  
  
  if( Object.values(cita).includes('') || cita.servicios.length === 0) {
    mostrarAlerta('Faltan Datos o Seleccionar al menos un Servicio', 'error', '.contenido-resumen', false);
    return;
  }
  

  //Formatear el DIV de Resumen
  const { nombre, fecha, hora, servicios } = cita;

  const nombreCliente = document.createElement('P');
  nombreCliente.innerHTML = `<span>Nombre:</span> ${nombre}`;

  //Darle formato a la Fecha
  const formatearFecha = (date, locale, options) => new Intl.DateTimeFormat(locale, options).format(date)
  
  const fechaSinFormato = new Date(fecha);
  fechaSinFormato.setDate(fechaSinFormato.getDate() + 1);
  fechaFormat = formatearFecha(fechaSinFormato, 'es', { weekday: 'long', month: 'long', day: 'numeric', year: 'numeric' });
  const fechaCita = document.createElement('P');
  fechaCita.innerHTML = `<span>Fecha Cita:</span> ${fechaFormat}`;

  const horaCita = document.createElement('P');
  horaCita.innerHTML = `<span>Hora Cita:</span> ${hora}`;

  //Tiempo Total de la Cita - Variable declarada publica - Su calculo se hace en el evento de elegir hora de la cita
  /*const tiempoTotal = servicios.reduce((tiempoTotal, tiempo) => tiempoTotal + parseFloat(tiempo.Tiempo), 0);
  let horaFinal = sumarMinutos(hora, tiempoTotal);
  cita.horaFin = horaFinal;*/
  const tiempoTotalP = document.createElement('P');
  tiempoTotalP.innerHTML = `<span>Tiempo Total:</span> ${tiempoTotal} Min - Finaliza a las ${horaFinal}`;
  
  resumen.appendChild(nombreCliente);
  resumen.appendChild(fechaCita);
  resumen.appendChild(horaCita);
  resumen.appendChild(tiempoTotalP);


  const cajaTabla = document.createElement('DIV');
  cajaTabla.classList.add('contenedor-tabla-serviciosSel');
  resumen.appendChild(cajaTabla);

  // Crea la tabla
  const tablaServiciosSel = document.createElement('TABLE');
  tablaServiciosSel.classList.add('servicios-seleccionados');

  // Crea la fila de encabezados
  const encabezado = document.createElement('THEAD');
  const filaEncabezado = document.createElement('TR');

  const encabezadoVacio = document.createElement('th'); // Campo vacío
  encabezadoVacio.appendChild(document.createTextNode(''));
  filaEncabezado.appendChild(encabezadoVacio);


  const encabezadoNombre = document.createElement('TH'); // Nombre
  encabezadoNombre.appendChild(document.createTextNode('Servicio'));
  filaEncabezado.appendChild(encabezadoNombre);

  const encabezadoPrecio = document.createElement('TH'); // Precio
  encabezadoPrecio.appendChild(document.createTextNode('Precio'));
  filaEncabezado.appendChild(encabezadoPrecio);

  encabezado.appendChild(filaEncabezado);
  tablaServiciosSel.appendChild(encabezado);

  // Crea el cuerpo de la tabla
  const cuerpo = document.createElement('TBODY');

  servicios.forEach(servicio => {
    const { ID, precio, nombre } = servicio;

    const contenedorServicio = document.createElement('DIV');
    contenedorServicio.classList.add('contenedor-servicio');

    const fila = document.createElement('TR');

    const celdaVacia = document.createElement('TD');
    celdaVacia.appendChild(document.createTextNode(''));
    fila.appendChild(celdaVacia);

    const celdaNombre = document.createElement('TD');
    celdaNombre.appendChild(document.createTextNode(nombre));
    fila.appendChild(celdaNombre);

    const celdaPrecio = document.createElement('TD');
    celdaPrecio.appendChild(document.createTextNode(precio));
    celdaPrecio.classList.add('descripcion-pagina');
    fila.appendChild(celdaPrecio);

    cuerpo.appendChild(fila);
  });
  tablaServiciosSel.appendChild(cuerpo);
  cajaTabla.appendChild(tablaServiciosSel);
 

  const cantServicios = document.createElement('P');
  cantServicios.innerHTML = `<span>Cantidad de Servicios:</span> ${servicios.length}`;
  resumen.appendChild(cantServicios);

  const subTotal = servicios.reduce((subTotal, servicio) => subTotal + parseFloat(servicio.precio), 0);
  const subTotalParrafo = document.createElement('P');
  subTotalParrafo.innerHTML = `<span>Sub-Total:</span> $${subTotal}`;
  resumen.appendChild(subTotalParrafo);

  const IVA = (subTotal * 0.16).toFixed(2);
  const IVAParrafo = document.createElement('P');
  IVAParrafo.innerHTML = `<span>IVA (16%):</span> $${IVA}`;
  resumen.appendChild(IVAParrafo);

  let TotalPagar = subTotal + parseFloat(IVA);
  let TotalPagarParrafo = document.createElement('P');
  
  
  let EquivalenteBs = (TotalPagar * TasaCambio).toFixed(2);
  EquivalenteBs = parseFloat(EquivalenteBs).toLocaleString('de-DE', { minimumFractionDigits: 2 }).replace(',', '.');
  TotalPagarParrafo.innerHTML = `<span>Total:</span> $${TotalPagar} - ( Bs. ${EquivalenteBs})`;
  resumen.appendChild(TotalPagarParrafo);

  const btnReservar = document.createElement('BUTTON');
  btnReservar.classList.add('boton');
  btnReservar.id = 'btn-reservar';
  btnReservar.textContent = 'Generar Cita';
  btnReservar.onclick = generarCita;
  resumen.appendChild(btnReservar);
  /*Si quiere pasarle un parametro a la funcion, genero un callback porque si lo hago alli directo lo que hare sera llamar a la funcion y no retorna nada
  btnReservar.onclick = function() {
    generarCita(parametro)
  }*/
  //console.log(cita);
}
async function generarCita(){
  const { fecha, hora, horaFin, clienteID, empleadoID, servicios } = cita;
  const servicioID = servicios.map( servicio => servicio.ID);

  const datos = new FormData();
  datos.append('fecha', fecha);
  datos.append('hora', hora);
  datos.append('horaFin', horaFin);
  datos.append('clienteID', clienteID);
  datos.append('empleadoID', empleadoID);
  
  datos.append('servicioID', servicioID);

  /*Descomenta para ver que datos estamos ENVIANDO al Back End
  console.log( [...datos] );
  return;*/

  try {
    //Peticion haciala API
  const URL = '/appsalon_mvc/public/index.php/api/citas';
  const respuesta = await fetch(URL, {
    method: 'POST',
    body: datos
  });
  const resultadoFront = await respuesta.json();
  console.log(resultadoFront);
  if(resultadoFront.resultado){
    Swal.fire({
      title: "APP Salon - Citas",
      text: "Cita Reservada con Exito",
      icon: "success",
      button: "OK"
    }).then( () => {
      window.location.reload();
    })
  }
  } catch (error) {
    Swal.fire({
      icon: "error",
      title: "Oops...",
      text: "Error: " + error,
      button: "OK"
    });
  }
  

}

async function consultarBarberos() {
  const { fecha, hora, horaFin } = cita;
  
  try {
    const datos = new FormData();
    
    datos.append('fecha', fecha);
    datos.append('hora', hora);
    datos.append('horaFin', horaFin);
    console.log( cita );
    
    const URL = '/appsalon_mvc/public/index.php/api/barberos';
    const respuesta = await fetch(URL, {
      method: 'POST',
      body: datos
    });
    const barberos = await respuesta.json();
    console.log(barberos);
    listarBarberos(barberos);
    
  } catch (error) {
    console.log(error);
  }
}
function listarBarberos(barberos) {
  
  const select = document.querySelector("#Barbero");
  select.innerHTML = "";
  let nuevaOpcion = document.createElement("OPTION");
  nuevaOpcion.value = 0;
  nuevaOpcion.text = '---SEL---';
  select.appendChild(nuevaOpcion);

  barberos.forEach( barbero => {
    const {ID, nombre} = barbero;
    
    nuevaOpcion = document.createElement("OPTION");
    nuevaOpcion.value = ID;
    nuevaOpcion.text = nombre;
    select.appendChild(nuevaOpcion);
    
    /*select.onclick = function() {
      dispBarbero(servicio);
    }*/
  });

}

//FIN DE LAS FUNCIONES DEL PAGINADOR Y DE LA API


function sumarMinutos(hora, minutos) {
  let [horaActual, minutosActuales] = hora.split(':');
  let totalMinutos = parseInt(minutosActuales) + minutos;

  let horasAdicionales = Math.floor(totalMinutos / 60);
  let minutosRestantes = totalMinutos % 60;

  horaActual = parseInt(horaActual) + horasAdicionales;

  if (horaActual > 23) {
      horaActual = horaActual - 24;
  }

  if (minutosRestantes < 10) {
      minutosRestantes = '0' + minutosRestantes;
  }

  return horaActual + ':' + minutosRestantes;
}



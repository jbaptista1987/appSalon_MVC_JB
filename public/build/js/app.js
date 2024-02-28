let paso=1;const pasoMin=1,pasoMax=3,btnSiguiente=document.querySelector("#siguiente"),btnAnterior=document.querySelector("#anterior"),alerta=document.createElement("DIV"),inputFecha=document.querySelector("#fecha");let tiempoTotal=0,horaFinal="",fechaFormat="",TasaCambio=0,cita={clienteID:"",nombre:"",fecha:"",hora:"",empleadoID:"",servicios:[]};function inciarApp(){mostrarSeccion(),tabs(),botonesPaginador(),paginaSiguiente(),paginaAnterior(),consultarAPI(),clienteID(),nombreCliente(),seleccionarBarbero(),seleccionarFecha(),seleccionarHora(),mostrarResumenCita()}function tabs(){document.querySelectorAll(".tabs button").forEach(e=>{e.addEventListener("click",(function(e){paso=parseInt(e.target.dataset.paso),mostrarSeccion(),botonesPaginador()}))})}function mostrarSeccion(){const e=document.querySelector(".mostrar");e&&e.classList.remove("mostrar");document.querySelector("#paso-"+paso).classList.add("mostrar");const t=document.querySelector(".actual");t&&t.classList.remove("actual");document.querySelector(`[data-paso="${paso}"]`).classList.add("actual")}function botonesPaginador(){const{servicios:e}=cita;1===paso&&(btnAnterior.classList.add("ocultarbtn"),btnSiguiente.classList.remove("ocultarbtn")),3===paso&&(btnAnterior.classList.remove("ocultarbtn"),btnSiguiente.classList.add("ocultarbtn"),mostrarResumenCita()),2===paso&&(btnAnterior.classList.remove("ocultarbtn"),btnSiguiente.classList.remove("ocultarbtn"),tiempoTotal=e.reduce((e,t)=>e+parseFloat(t.Tiempo),0)),mostrarSeccion()}function paginaAnterior(){btnAnterior.addEventListener("click",(function(){paso<=1||(paso--,botonesPaginador())}))}function paginaSiguiente(){btnSiguiente.addEventListener("click",(function(){paso>=3||(paso++,botonesPaginador())}))}async function consultarAPI(){try{const e="/appsalon_mvc/public/index.php/api/servicios",t=await fetch(e);mostrarServicios(await t.json())}catch(e){console.log(e)}}function mostrarServicios(e){e.forEach(e=>{const{ID:t,nombre:n,precio:a,Tiempo:o}=e,c=document.createElement("P");c.classList.add("nombre-servicio"),c.textContent=n;const r=document.createElement("P");r.classList.add("precio-servicio"),r.textContent="$ "+a;const i=document.createElement("P");i.classList.add("nombre-servicio"),i.textContent="Tiempo: "+o+" Min";const s=document.createElement("DIV");s.classList.add("servicio"),s.dataset.idServicio=t,s.onclick=function(){seleccionarServicio(e)},s.appendChild(c),s.appendChild(r),s.appendChild(i),document.querySelector("#servicios").appendChild(s)})}function seleccionarServicio(e){const{ID:t}=e,{servicios:n}=cita,a=document.querySelector(`[data-id-servicio="${t}"]`);n.some(e=>e.ID===t)?cita.servicios=n.filter(e=>e.ID!==t):cita.servicios=[...n,e],a.classList.toggle("seleccionado")}function clienteID(){const e=document.querySelector("#clienteID").value;cita.clienteID=e}function nombreCliente(){const e=document.querySelector("#nombre").value;cita.nombre=e}function seleccionarBarbero(){document.querySelector("#Barbero").addEventListener("change",(function(){this.value>0&&(cita.empleadoID=this.value)}))}function seleccionarFecha(){inputFecha.addEventListener("input",(function(e){const t=new Date(e.target.value).getUTCDay();[0,1].includes(t)?(e.target.value="",mostrarAlerta("Domingo y Lunes No Laboramos","error",".formulario")):cita.fecha=e.target.value}))}function seleccionarHora(){const{nombre:e,fecha:t,hora:n,horaFin:a,servicios:o}=cita;document.querySelector("#hora").addEventListener("input",(function(e){let t=e.target.value.split(":")[0];t<8||t>17?(e.target.value="",mostrarAlerta("Hora No Valida","error",".formulario")):(cita.hora=e.target.value,horaFinal=sumarMinutos(cita.hora,tiempoTotal),cita.horaFin=horaFinal,consultarBarberos())}))}function mostrarAlerta(e,t,n,a=!0){const o=document.querySelector(".error");o&&o.remove(),alerta.textContent=e,alerta.classList.add("errorLlenado"),alerta.classList.add(t);document.querySelector(n).appendChild(alerta),a&&setTimeout(()=>{alerta.remove()},2e3)}function mostrarResumenCita(){const e=document.querySelector(".contenido-resumen");for(;e.firstChild;)e.removeChild(e.firstChild);if(Object.values(cita).includes("")||0===cita.servicios.length)return void mostrarAlerta("Faltan Datos o Seleccionar al menos un Servicio","error",".contenido-resumen",!1);const{nombre:t,fecha:n,hora:a,servicios:o}=cita,c=document.createElement("P");c.innerHTML="<span>Nombre:</span> "+t;const r=new Date(n);var i,s,l;r.setDate(r.getDate()+1),i=r,s="es",l={weekday:"long",month:"long",day:"numeric",year:"numeric"},fechaFormat=new Intl.DateTimeFormat(s,l).format(i);const d=document.createElement("P");d.innerHTML="<span>Fecha Cita:</span> "+fechaFormat;const p=document.createElement("P");p.innerHTML="<span>Hora Cita:</span> "+a;const u=document.createElement("P");u.innerHTML=`<span>Tiempo Total:</span> ${tiempoTotal} Min - Finaliza a las ${horaFinal}`,e.appendChild(c),e.appendChild(d),e.appendChild(p),e.appendChild(u);const m=document.createElement("DIV");m.classList.add("contenedor-tabla-serviciosSel"),e.appendChild(m);const h=document.createElement("TABLE");h.classList.add("servicios-seleccionados");const v=document.createElement("THEAD"),b=document.createElement("TR"),f=document.createElement("th");f.appendChild(document.createTextNode("")),b.appendChild(f);const C=document.createElement("TH");C.appendChild(document.createTextNode("Servicio")),b.appendChild(C);const S=document.createElement("TH");S.appendChild(document.createTextNode("Precio")),b.appendChild(S),v.appendChild(b),h.appendChild(v);const T=document.createElement("TBODY");o.forEach(e=>{const{ID:t,precio:n,nombre:a}=e;document.createElement("DIV").classList.add("contenedor-servicio");const o=document.createElement("TR"),c=document.createElement("TD");c.appendChild(document.createTextNode("")),o.appendChild(c);const r=document.createElement("TD");r.appendChild(document.createTextNode(a)),o.appendChild(r);const i=document.createElement("TD");i.appendChild(document.createTextNode(n)),i.classList.add("descripcion-pagina"),o.appendChild(i),T.appendChild(o)}),h.appendChild(T),m.appendChild(h);const E=document.createElement("P");E.innerHTML="<span>Cantidad de Servicios:</span> "+o.length,e.appendChild(E);const g=o.reduce((e,t)=>e+parseFloat(t.precio),0),L=document.createElement("P");L.innerHTML="<span>Sub-Total:</span> $"+g,e.appendChild(L);const D=(.16*g).toFixed(2),I=document.createElement("P");I.innerHTML="<span>IVA (16%):</span> $"+D,e.appendChild(I);let y=g+parseFloat(D),F=document.createElement("P"),x=(y*TasaCambio).toFixed(2);x=parseFloat(x).toLocaleString("de-DE",{minimumFractionDigits:2}).replace(",","."),F.innerHTML=`<span>Total:</span> $${y} - ( Bs. ${x})`,e.appendChild(F);const P=document.createElement("BUTTON");P.classList.add("boton"),P.id="btn-reservar",P.textContent="Generar Cita",P.onclick=generarCita,e.appendChild(P)}async function generarCita(){const{fecha:e,hora:t,horaFin:n,clienteID:a,empleadoID:o,servicios:c}=cita,r=c.map(e=>e.ID),i=new FormData;i.append("fecha",e),i.append("hora",t),i.append("horaFin",n),i.append("clienteID",a),i.append("empleadoID",o),i.append("servicioID",r);try{const e="/appsalon_mvc/public/index.php/api/citas",t=await fetch(e,{method:"POST",body:i}),n=await t.json();console.log(n),n.resultado&&Swal.fire({title:"APP Salon - Citas",text:"Cita Reservada con Exito",icon:"success",button:"OK"}).then(()=>{window.location.reload()})}catch(e){Swal.fire({icon:"error",title:"Oops...",text:"Error: "+e,button:"OK"})}}async function consultarBarberos(){const{fecha:e,hora:t,horaFin:n}=cita;try{const a=new FormData;a.append("fecha",e),a.append("hora",t),a.append("horaFin",n),console.log(cita);const o="/appsalon_mvc/public/index.php/api/barberos",c=await fetch(o,{method:"POST",body:a}),r=await c.json();console.log(r),listarBarberos(r)}catch(e){console.log(e)}}function listarBarberos(e){const t=document.querySelector("#Barbero");t.innerHTML="";let n=document.createElement("OPTION");n.value=0,n.text="---SEL---",t.appendChild(n),e.forEach(e=>{const{ID:a,nombre:o}=e;n=document.createElement("OPTION"),n.value=a,n.text=o,t.appendChild(n)})}function sumarMinutos(e,t){let[n,a]=e.split(":"),o=parseInt(a)+t,c=Math.floor(o/60),r=o%60;return n=parseInt(n)+c,n>23&&(n-=24),r<10&&(r="0"+r),n+":"+r}document.addEventListener("DOMContentLoaded",(function(){if(fetch("https://api.exchangerate-api.com/v4/latest/USD").then(e=>e.json()).then(e=>{TasaCambio=e.rates.VES}).catch(e=>console.error("Error:",e)),document.querySelector("#paso-1")&&(cita.fecha=inputFecha.value,inciarApp()),document.querySelector("#Tipo_Usuario")){const e=document.getElementById("Tipo_Usuario"),t=document.getElementById("divMensaje");e.addEventListener("change",()=>{"2"==e.value?divMensaje.innerText="Tu Solicitud debera ser Aprobada por la Gerencia":t.innerText=""})}if(document.querySelector("#countdown")){const e=document.getElementById("countdown"),t="/appsalon_mvc/public/index.php",n=setInterval(()=>{const a=parseInt(e.textContent);if(a<=1)return clearInterval(n),void(window.location=t);e.textContent=a-1},1e3)}}));
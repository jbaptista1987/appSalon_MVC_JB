let accion="",nuevoEstatus="",usuarioIDsString="",Cliente={ID:"",Usuario:"",Doc:"",Identificacion:"",Nombre:"",Correo:"",Telefono:"",Tipo_Usuario:"",Estatus:""},Validador={},regUsuario={Doc:"",Identificacion:"",Nombre:"",Apellido:"",Correo:"",Telefono:"",Usuario:"",Clave:"",Tipo_Usuario:"",Estatus:"2"};function delUsuarios(){document.querySelector("#pruebasID").addEventListener("click",e=>{e.preventDefault(),(async()=>{const{value:e}=await Swal.fire({title:"Que Desea Hacer?",input:"select",inputOptions:{2:"Aprobar / Activar Usuario",3:"Suspender Usuario"},inputPlaceholder:"Seleccionar una Opcion",showCancelButton:!0});document.querySelector(".swal2-popup").addEventListener("click",r=>{if("OK"===r.target.innerText){nuevoEstatus=e;const r=document.querySelectorAll('input[type="checkbox"]'),o=[];r.forEach(e=>{if(e.checked){const r=e.getAttribute("data-value");o.push(r)}}),usuarioIDsString="('"+o.join("','")+"')",delUsuariosSel()}})})()})}async function delUsuariosSel(){try{const e=new FormData;e.append("IDs",usuarioIDsString),e.append("estatus",nuevoEstatus),e.append("accion","modificar");const r="/crudusuarios",o=await fetch(r,{method:"POST",body:e}),t=await o.json();console.log(t),window.location.reload()}catch(e){console.log(e)}}function displayUsuario(){document.querySelectorAll("tbody .linkUsuario").forEach(e=>{e.addEventListener("click",(function(e){e.preventDefault();let r=this.closest("tr").querySelector("td:first-child input[type='checkbox']");Cliente.ID=r.dataset.value;let o=this.closest("tr").querySelector("input.docUsuario");Cliente.Doc=o.value;let t=this.closest("tr").querySelector("input.identUsuario");Cliente.Identificacion=t.value;let a=this.closest("tr").querySelector("input.telefonoUsuario");Cliente.Telefono=a.value;let i=this.closest("tr").querySelector("input.correoUsuario");Cliente.Correo=i.value;var n=this.closest("tr");Cliente.Nombre=n.querySelector("td:nth-child(2)").innerText;var l=this.closest("tr");Cliente.Usuario=l.querySelector("td:nth-child(3)").innerText;var s=this.closest("tr");Cliente.Tipo_Usuario=s.querySelector("td:nth-child(4)").innerText;s=this.closest("tr");Cliente.Estatus=s.querySelector("td:nth-child(5)").innerText,console.log(Cliente),ventanaUsuario()}))})}async function ventanaUsuario(){const{value:e}=await Swal.fire({title:"Ficha del Cliente",html:`\n      <div class="swalModal">\n      <strong>ID:</strong> ${Cliente.ID} <br>\n\n      <strong>Usuario:</strong> ${Cliente.Usuario} <br>\n\n      <strong>Ident:</strong> ${Cliente.Doc}-${Cliente.Identificacion} <br>\n\n      <strong>Cliente:</strong> ${Cliente.Nombre} <br>\n\n      <strong>Telefono:</strong> ${Cliente.Telefono} <br>\n\n      <strong>Correo:</strong> ${Cliente.Correo} <br>\n\n      <strong>Tipo:</strong> ${Cliente.Tipo_Usuario} <br>\n\n      <strong>Estatus:</strong> ${Cliente.Estatus}\n      </div>\n    `,customClass:{container:"swal-container-large-font"},focusConfirm:!1,width:"auto"})}function mostrarIMGprevia(){const e=document.getElementById("Imagen"),r=document.getElementById("imagePreview");e.addEventListener("change",()=>{const o=e.files[0],t=new FileReader;t.onload=e=>{r.src=e.target.result},t.readAsDataURL(o)})}function validarFrmRegUsuario(){document.querySelector("#btnRegistrarU").addEventListener("click",(function(e){e.preventDefault(),Validador.error=[];let r=document.querySelector("#Doc").value;regUsuario.Doc=r,"0"==r&&Validador.error.push("* El Doc es Requerido");let o=document.querySelector("#Identificacion").value;regUsuario.Identificacion=o,""==o.trim()&&Validador.error.push("* CI es Requerida");let t=document.querySelector("#nombreR").value;regUsuario.Nombre=t,""==t.trim()&&Validador.error.push("* El Nombre es Requerido");let a=document.querySelector("#apellido").value;regUsuario.Apellido=a,""==a.trim()&&Validador.error.push("* El Apellido es Requerido");let i=document.querySelector("#telefono").value;regUsuario.Telefono=i,""!=i.trim()&&validarTelefono(i)||Validador.error.push("* Telefono es Requerido y con Formato XXXX-XXXXXXX");let n=document.querySelector("#correo").value;regUsuario.Correo=n,""!=n.trim()&&validarEmail(n)||Validador.error.push("* Correo en formato Valido es Requerido");let l=document.querySelector("#usuario").value;regUsuario.Usuario=l,""==l.trim()&&Validador.error.push("* El Usuario es Requerido");let s=document.querySelector("#clave").value;regUsuario.Clave=s,(s.match(/\s/)||0===s.length)&&Validador.error.push("* La Clave es Requerida");let u=document.querySelector("#Tipo_Usuario").value;if(regUsuario.Tipo_Usuario=u,"0"==u&&Validador.error.push("* El Tipo de Usuario es Requerido"),0===Validador.error.length)registrarUsuarioCRUD();else{console.log(Validador.error);const e=Validador.error.join("<br>");Swal.fire({icon:"error",title:"Validacion de Formulario",html:'<div class="swalmodalerror">'+e+"</div>"})}}))}async function registrarUsuarioCRUD(){const{Doc:e,Identificacion:r,Nombre:o,Apellido:t,Correo:a,Telefono:i,Usuario:n,Clave:l,Tipo_Usuario:s,Estatus:u}=regUsuario;try{const c=new FormData;c.append("Doc",e),c.append("Identificacion",r),c.append("Nombre",o),c.append("Apellido",t),c.append("Correo",a),c.append("Telefono",i),c.append("Usuario",n),c.append("Clave",l),c.append("Tipo_Usuario",s),c.append("Estatus",u),c.append("accion","crear");const d="/crudusuarios",p=await fetch(d,{method:"POST",body:c}),m=await p.json();m.ErrorU&&(Validador.error=[],Validador.error=m.ErrorU,Swal.fire({icon:"error",title:"Validacion de Formulario",html:'<div class="swalmodalerror">'+Validador.error+"</div>"})),m.ErrorC&&(Validador.error=[],Validador.error=m.ErrorC,Swal.fire({icon:"error",title:"Validacion de Formulario",html:'<div class="swalmodalerror">'+Validador.error+"</div>"})),console.log(m),window.location.reload()}catch(e){console.log(e)}}document.addEventListener("DOMContentLoaded",(function(){delUsuarios(),displayUsuario(),mostrarIMGprevia(),validarFrmRegUsuario()}));
function iniciarAppAdmin(){buscarFecha()}function buscarFecha(){document.querySelector("#fecha").addEventListener("input",(function(e){fechaSel=e.target.value,window.location="?fecha="+fechaSel}))}function confirmDelete(e){document.querySelector("#btnEliminarCita").addEventListener("click",e=>{e.preventDefault(),Swal.fire({title:"Confirmación",text:"¿Estás seguro de que deseas eliminar este registro/cita?",icon:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"Confirmar",cancelButtonText:"Cancelar",padding:"4rem"}).then(e=>{e.isConfirmed&&document.getElementById("frmEliminarCita").submit()})})}document.addEventListener("DOMContentLoaded",(function(){iniciarAppAdmin()}));
document.addEventListener('DOMContentLoaded', function() {
    
    iniciarAppAdmin();
});

function iniciarAppAdmin(){
    buscarFecha();
}
function buscarFecha(){
    const fechaCitas = document.querySelector("#fecha");
    fechaCitas.addEventListener('input', function(e) {
        fechaSel = e.target.value;
        window.location = "?fecha=" + fechaSel;
    });
    
}

function confirmDelete(event) {     
    let btnEliminarCita = document.querySelector('#btnEliminarCita'); 
    btnEliminarCita.addEventListener('click', e => {
        e.preventDefault();
        Swal.fire({         
            title: 'Confirmación',         
            text: '¿Estás seguro de que deseas eliminar este registro/cita?',         
            icon: 'warning',
            showCancelButton: true, 
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirmar',
            cancelButtonText: 'Cancelar',
            padding: "4rem"
        })  
        .then((result) => { 
            if (result.isConfirmed) {
                document.getElementById("frmEliminarCita").submit(); 
            }  
        });     
    });       
}        
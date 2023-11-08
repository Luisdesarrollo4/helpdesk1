// Cargar la tabla de asignaciones al cargar el documento
$(document).ready(function(){
    $('#tablaAsignacionesLoad').load('asignacion/tablaAsignacion.php');
});

// Asignar un equipo
function asignarEquipo() {
    $.ajax({
        type: 'POST',
        data: $('#frmAsignaEquipo').serialize(),
        url: '../procesos/asignacion/asignar.php',
        success: function(respuesta) {
            respuesta = respuesta.trim();

            if (respuesta == 1) {
                $('#frmAsignaEquipo')[0].reset();
                $('#tablaAsignacionesLoad').load('asignacion/tablaAsignacion.php');
                Swal.fire(":D", "¡Asignado con éxito!", "success");
            } else {
                Swal.fire(":(", "¡Fallo al asignar! " + respuesta, "error");
            }
        }
    });
    return false;
}

// Eliminar una asignación
function eliminarAsigancion(idAsignacion) {
    Swal.fire({
        title: '¿Estás seguro de eliminar este registro?',
        text: 'Una vez eliminado no podrá ser recuperado.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, seguro!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'POST',
                data: 'idAsigancion=' + idAsignacion,
                url: '../procesos/asignacion/eliminarAsignacion.php',
                success: function(respuesta) {
                    respuesta = respuesta.trim();
    
                    if (respuesta == 1) {
                        $('#tablaAsignacionesLoad').load('asignacion/tablaAsignacion.php');
                        Swal.fire(":D", "¡Eliminado con éxito!", "success");
                    } else {
                        Swal.fire(":(", "¡Fallo al eliminar! " + respuesta, "error");
                    }
                }
            });
        }
    });
    return false;
}

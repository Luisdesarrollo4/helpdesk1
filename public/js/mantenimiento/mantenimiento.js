// Cargar la tabla de mantenimiento al cargar el documento
$(document).ready(function() {
    $('#tablaMantenimientoLoad').load('mantenimiento/tablaMantenimiento.php');
});

// Función para realizar el mantenimiento
function mantenimiento() {
    $.ajax({
        type: 'POST',
        data: $('#frmMantenimiento').serialize(),
        url: '../procesos/mantenimiento/guardar_mantenimiento.php',
        success: function(respuesta) {
            respuesta = respuesta.trim();
            if (respuesta == 1) {
                $('#tablaMantenimientoLoad').load('mantenimiento/tablaMantenimiento.php');
                $('#frmMantenimiento')[0].reset();
                Swal.fire(':D', 'Agregado con éxito!', 'success');
            } else {
                Swal.fire(':c', 'Error al cargar' + respuesta, 'error');
            }
        }
    });
    return false;
}

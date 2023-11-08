// Cargar tabla de reportes de clientes al cargar el documento
$(document).ready(function() {
    $('#tablaReporteClienteLoad').load('reportesCliente/tablaReporteCliente.php');
});

// Función para agregar un nuevo reporte de cliente
function agregarNuevoReporte() {
    // Realizar una solicitud AJAX al archivo "agregarNuevoReporte.php"
    $.ajax({
        type: "POST",
        data: $('#frmNuevoReporte').serialize(), // Obtener los datos del formulario de nuevo reporte
        url: "../procesos/reportesCliente/agregarNuevoReporte.php", // URL del archivo PHP que procesa el nuevo reporte
        success: function(respuesta) {
            respuesta = respuesta.trim(); // Eliminar espacios en blanco al inicio y final de la respuesta

            if (respuesta == 1) {
                // Actualizar la tabla de reportes de clientes
                $('#tablaReporteClienteLoad').load('reportesCliente/tablaReporteCliente.php');
                $('#frmNuevoReporte')[0].reset(); // Reiniciar el formulario de nuevo reporte
                Swal.fire(":D", "Agregado con éxito!", "success");
            } else {
                Swal.fire(":c", "Error al cargar: " + respuesta, "error");
            }
        }
    });

    return false; // Evitar el envío tradicional del formulario
}

// Función para eliminar un reporte de cliente
function eliminarReporteCliente(idReporte) {
    Swal.fire({
        title: '¿Estás seguro de eliminar este registro?',
        text: "Una vez eliminado no podrá ser recuperado.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡Sí, seguro!'
    }).then((result) => {
        if (result.isConfirmed) {
            // Realizar una solicitud AJAX para eliminar el reporte de cliente
            $.ajax({
                type: "POST",
                data: "idReporte=" + idReporte,
                url: "../procesos/reportesCliente/eliminarReporteCliente.php",
                success: function(respuesta) {
                    respuesta = respuesta.trim(); // Eliminar espacios en blanco al inicio y final de la respuesta
        
                    if (respuesta == 1) {
                        // Actualizar la tabla de reportes de clientes
                        $('#tablaReporteClienteLoad').load('reportesCliente/tablaReporteCliente.php');
                        Swal.fire(":D", "¡Eliminado con éxito!", "success");
                    } else {
                        Swal.fire(":(", "Fallo al eliminar: " + respuesta, "error");
                    }
                }
            });
        }
    });

    return false; // Evitar el comportamiento predeterminado del enlace
}
function obtenerDatosSolucion(idReporte) {
    $.ajax({
        type: 'POST',
        data: 'idReporte=' + idReporte,
        url: '../procesos/reportesAdmin/obtenerSolucion.php',
        success: function(respuesta) {
            respuesta = jQuery.parseJSON(respuesta);
            $('#idReporte').val(respuesta['idReporte']);
            $('#solucion').val(respuesta['solucion']);
            $('#estatus').val(respuesta['estatus']);
        }
    });
}

// Función para agregar la solución de un reporte
function agregarSolucionReporte() {
    $.ajax({
        type: 'POST',
        data: $('#frmAgregarSolucionReporte').serialize(),
        url: '../procesos/reportesAdmin/actualizarSolucion.php',
        success: function(respuesta) {
            respuesta = respuesta.trim();

            if (respuesta == 1) {
                Swal.fire(':D', 'Agregado con éxito!', 'success');
                $('#tablaReporteAdminLoad').load('reportesAdmin/tablaReportesAdmin.php');
            } else {
                Swal.fire(':(', 'Fallo!' + respuesta, 'error');
            }
        }
    });
    return false;
}
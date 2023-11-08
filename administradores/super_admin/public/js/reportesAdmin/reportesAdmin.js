// Cargar tabla de reportes de administrador al cargar el documento
$(document).ready(function() {
    $('#tablaReporteAdminLoad').load('reportesAdmin/tablaReportesAdmin.php');
});

// Función para eliminar un reporte de administrador
function eliminarReporteAdmin(idReporte) {
    Swal.fire({
        title: '¿Estás seguro de eliminar este registro?',
        text: 'Una vez eliminado no podrá ser recuperado.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡Sí, seguro!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'POST',
                data: 'idReporte=' + idReporte,
                url: '../procesos/reportesCliente/eliminarReporteCliente.php',
                success: function(respuesta) {
                    respuesta = respuesta.trim();

                    if (respuesta == 1) {
                        $('#tablaReporteClienteLoad').load('reportesCliente/tablaReporteCliente.php');
                        Swal.fire(':D', 'Eliminado con éxito!', 'success');
                    } else {
                        Swal.fire(':(', 'Fallo al Eliminar!' + respuesta, 'error');
                    }
                }
            });
        }
    });
    return false;
}

// Función para obtener los datos de solución de un reporte
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

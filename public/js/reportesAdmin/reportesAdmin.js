// Cargar tabla de reportes de administrador al cargar el documento
$(document).ready(function() {
    $('#tablaReporteAdminLoad').load('reportesAdmin/tablaReportesAdmin.php');
});
function toggleChat(ReportId) {
    console.log(`Toggling chat for report ID: ${ReportId}`);
    const chatDiv = document.getElementById(`chat-${ReportId}`);
    console.log(chatDiv.style.display);
    if (chatDiv.style.display === 'none') {
        chatDiv.style.display = 'block';
    } else {
        chatDiv.style.display = 'none';
    }
}
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
        url: '../procesos/report    esAdmin/actualizarSolucion.php',
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
// Función para asignar usuario a un reporte
function asignarUsuario(idUsuarioAsignado, idReporte) {
    // Agrega un mensaje de registro en JavaScript
    console.log('Asignando usuario: ' + idUsuarioAsignado + ' al reporte: ' + idReporte);
    
    // Realiza una petición AJAX para asignar el usuario
    $.ajax({
        type: 'POST',
        url: '../procesos/reportesAdmin/asignar_usuario.php',
        data: {
            idUsuarioAsignado: idUsuarioAsignado,
            idReporte: idReporte
        },
        success: function (data) {
            // Agrega un mensaje de registro para la respuesta del servidor
            console.log('Respuesta del servidor: ' + data);
            
            // Actualiza el span con el nombre del usuario asignado
            $('#usuario_asignado_' + idReporte).html(data);
            
            if (data.trim() === "Datos incorrectos") {
                console.log('Fallo en la asignación');
            } else {
                location.reload(true); // Recargar la página desde el servidor
                console.log('Asignación exitosa');
                
            }
        },
        error: function(xhr, textStatus, errorThrown) {
            // Agrega un mensaje de registro para los errores de la petición AJAX
            console.log('Error en la petición AJAX: ' + errorThrown);
        }
    });
}
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


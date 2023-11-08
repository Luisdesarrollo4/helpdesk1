// Cargar tabla de reportes de clientes al cargar el documento
$(document).ready(function() {
    $('#tablaReporteClienteLoad').load('reportesCliente/tablaReporteCliente.php');
});

// Función para agregar un nuevo reporte de cliente
function agregarNuevoReporte() {
    // Realizar una solicitud AJAX al archivo "agregarNuevoReporte.php"
    $.ajax({
        type: "POST",
        data: $('#frmNuevoReporte').serialize(),
        url: "../procesos/reportesCliente/agregarNuevoReporte.php",
        success: function(respuesta) {
            respuesta = respuesta.trim();

            console.log("Respuesta del servidor en agregarNuevoReporte:", respuesta); // Agregar esta línea

            if (respuesta == 1) {
                $('#tablaReporteClienteLoad').load('reportesCliente/tablaReporteCliente.php');
                $('#frmNuevoReporte')[0].reset();
                Swal.fire(":D", "Agregado con éxito!", "success");
            } else {
                Swal.fire(":c", "Error al cargar: " + respuesta, "error");
            }
        }
    });

    return false;
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
                    respuesta = respuesta.trim();

                    console.log("Respuesta del servidor en eliminarReporteCliente:", respuesta); // Agregar esta línea

                    if (respuesta == 1) {
                        $('#tablaReporteClienteLoad').load('reportesCliente/tablaReporteCliente.php');
                        Swal.fire(":D", "¡Eliminado con éxito!", "success");
                    } else {
                        Swal.fire(":(", "Fallo al eliminar: " + respuesta, "error");
                    }
                }
            });
        }
    });

    return false;
}

function obtenerDatosSolucionCliente(idReporte) {
    $.ajax({
        type: 'POST',
        data: 'idReporte=' + idReporte,
        url: '../procesos/reportesCliente/obtenerSolucionCliente.php',
        success: function(respuesta) {
            try {
                respuesta = jQuery.parseJSON(respuesta);
                if (respuesta && respuesta.idReporte) {
                    $('#idReporte').val(respuesta.idReporte);
                    $('#solucion').val(respuesta.solucion);
                    $('#estatus').val(respuesta.estatus);
                } else {
                    console.error("La respuesta del servidor no contiene datos válidos.");
                }
            } catch (error) {
                console.error("Error al analizar la respuesta del servidor: " + error);
            }
        },
        error: function(xhr, textStatus, errorThrown) {
            console.error("Error en la solicitud AJAX: " + textStatus + " - " + errorThrown);
        }
    });
}


function agregarSolucionReporteCliente() {
    $.ajax({
        type: 'POST',
        data: $('#modalCambiarEstatus').serialize(),
        url: '../procesos/reportesCliente/actualizarSolucionCliente.php',
        success: function(respuesta) {
            respuesta = respuesta.trim();
            var solucionIngresada = $('#solucion').val();
    
            // Mostrar la solución en el div solucionMostrada
            var solucionMostrada = $('#solucionMostrada');
            solucionMostrada.empty(); // Limpiamos el contenido anterior (si lo hay)
            solucionMostrada.append('<p><strong>Escribie la Solucion:</strong></p>');
            solucionMostrada.append('<p>' + solucionIngresada + '</p>');
            solucionMostrada.show(); // Mostramos el div solucionMostrada
    
            // Restaurar el valor original en el campo "Descripción de la solución"
            $('#solucion').val('');
    
            if (respuesta == 1) {
                Swal.fire(':D', 'Agregado con éxito!', 'success');
                // Obtener la nueva solución ingresada
                var nuevaSolucion = $('#solucion').val();
    
                // Agregar la nueva solución al div solucionMostrada usando el método append
                $('#solucionMostrada').append('<p>' + nuevaSolucion + '</p>');
    
                // Limpiar el campo de solución en la modal para que pueda agregar otra solución
                $('#solucion').val('');
    
                // Opcional: Después de agregar, también puedes ocultar la modal si lo deseas
                $('#modalCambiarEstatus').modal('hide');
                $('#tablaReporteClienteLoad').load('reportesCliente/tablaReportesCliente.php');
            } else {
                Swal.fire(':(', 'Fallo!' + respuesta, 'error');
            }
        }
    });
    return false;
    }

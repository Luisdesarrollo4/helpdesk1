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


// Código para agregar la solución al reporte mediante AJAX
function agregarSolucionReporte() {
$.ajax({
    type: 'POST',
    data: $('#frmAgregarSolucionReporte').serialize(),
    url: '../procesos/reportesAdmin/actualizarSolucion.php',
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
            $('#modalAgregarSolucionReporte').modal('hide');
            $('#tablaReporteAdminLoad').load('reportesAdmin/tablaReportesAdmin.php');
        } else {
            Swal.fire(':(', 'Fallo!' + respuesta, 'error');
        }
    }
});
return false;
}






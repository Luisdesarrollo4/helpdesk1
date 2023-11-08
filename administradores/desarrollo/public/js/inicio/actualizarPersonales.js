// Actualizar los datos personales
function actualizarDatosPersonales() {
    $.ajax({
        type: 'POST',
        data: $('#frmActuializarDatosPersonales').serialize(),
        url: '../procesos/inicio/actualizarPersonales.php',
        success: function(respuesta) {
            respuesta = respuesta.trim();
            if (respuesta == 1) {
                Swal.fire(":D", "¡Actualizado con éxito!", "success");
                location.reload(); // Recargar la página después de la actualización
            } else {
                Swal.fire(":(", "¡Fallo al actualizar! " + respuesta, "error");
            }
        }
    });
    return false;
}

// Obtener los datos personales al inicio
function obtenerDatosPersonalesInicio(idUsuario) {
    $.ajax({
        type: 'POST',
        data: 'idUsuario=' + idUsuario,
        url: '../procesos/usuarios/crud/obtenerDatosUsuario.php',
        success: function(respuesta) {
            respuesta = jQuery.parseJSON(respuesta);
            $('#tipoDocumentoinicio').val(respuesta['tipoDocumento']);
            $('#numeroDocumentoinicio').val(respuesta['numeroDocumento']);
            $('#apellidos').text(respuesta['apellidos']);
            $('#nombresinicio').val(respuesta['nombres']);
            $('#telefonoinicio').val(respuesta['telefono']);
            $('#correoinicio').val(respuesta['correo']);
            $('#areainicio').val(respuesta['area']);
            $('#oficina').val(respuesta['oficina']);
        }
    });
}

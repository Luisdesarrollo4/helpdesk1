// Obtener los datos personales al inicio
function datosPersonalesInicio(idUsuario) {
    $.ajax({
        type: 'POST',
        data: 'idUsuario=' + idUsuario,
        url: '../procesos/usuarios/crud/obtenerDatosUsuario.php',
        success: function(respuesta) {
            respuesta = jQuery.parseJSON(respuesta);
            $('#tipo_documento').text(respuesta['tipoDocumento']);
            $('#numero_documento').text(respuesta['numeroDocumento']);
            $('#apellidosa').text(respuesta['apellidos']);
            $('#nombresa').text(respuesta['nombres']);
            $('#telefono').text(respuesta['telefono']);
            $('#correo').text(respuesta['correo']);
            $('#areaa').text(respuesta['area']);
            $('#oficina').text(respuesta['oficina']);
        }
    });
}

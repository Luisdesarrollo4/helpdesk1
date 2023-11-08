$(document).ready(function(){
    // Cargar la tabla de usuarios al cargar el documento
    $('#tablaUsuarioLoad').load("usuarios/tablaUsuarios.php");
});

// Función para agregar un nuevo usuario desde la tabla
function agregarNuevoUsuario(){
    $.ajax({
        type: "POST",
        data: $('#frmAgregarUsuario').serialize(),
        url: "../procesos/usuarios/crud/agregarNuevoUsuario.php",
        success:function(respuesta){
            respuesta = respuesta.trim();
            if (respuesta == 1) {
                // Actualizar la tabla de usuarios después de agregar uno nuevo
                $('#tablaUsuarioLoad').load("usuarios/tablaUsuarios.php");
                $('#frmAgregarUsuario')[0].reset();
                Swal.fire(":D" , "Agregado con éxito!" , "success");    
            } else {
                Swal.fire(":c","Error al cargar" + respuesta, "error");
            }
        }
    });
    return false;
}

function obtenerDatosUsuario(idUsuario){
    $.ajax({
        type: "POST",
        data : "idUsuario=" + idUsuario,
        url :"../procesos/usuarios/crud/obtenerDatosUsuario.php",
        success : function(respuesta){
            respuesta = jQuery.parseJSON(respuesta);
            // Asignar los valores obtenidos a los campos correspondientes
            $('#idUsuario').val(respuesta['idUsuario']);
            $('#tipoDocumentou').val(respuesta['tipoDocumento']);
            $('#numeroDocumentou').val(respuesta['numeroDocumento']);
            $('#apellidosu').val(respuesta['apellidos']);
            $('#nombresu').val(respuesta['nombres']);
            $('#oficinau').val(respuesta['oficina']);
            $('#telefonou').val(respuesta['telefono']);
            $('#correou').val(respuesta['correo']);
            $('#usuariou').val(respuesta['nombreUsuario']);
            $('#idRolu').val(respuesta['idRol']);
            $('#areau').val(respuesta['area']);   
        }
    });
}

function actualizarUsuario(){
    $.ajax ({
        type : "POST",
        data:$('#frmActualizarUsuario').serialize(),
        url :"../procesos/usuarios/crud/actualizarUsuario.php",
        success: function(respuesta){
            respuesta = respuesta.trim();
            $("#modalActualizarUsuarios").html(respuesta);
            if (respuesta == 1) {
                // Actualizar la tabla de usuarios después de actualizar uno
                $('#modalActualizarUsuarios').modal('hide');
                $('#tablaUsuarioLoad').load("usuarios/tablaUsuarios.php");
                Swal.fire(":D" , "Actualizado con éxito!" , "success");    
            } else {
                Swal.fire(":c","Error al actualizar" + respuesta, "error");
            }
        }
    });
    return false;
}

function agregarIdUsuarioReset(idUsuario){
    $('#idUsuarioReset').val(idUsuario);
}

function resetPassword(){
    $.ajax({
        type:"POST",
        data:$('#frmActualizaPassword').serialize(),
        url:"../procesos/usuarios/extras/resetPassword.php",
        success:function(respuesta) {
            respuesta = respuesta.trim();
            if (respuesta == 1) {
                $('#modalResetPassword').modal('hide');
                Swal.fire(":D" , "Cambio con éxito!" , "success");    
            } else {
                Swal.fire(":c","Error al Cambiar" + respuesta, "error");
            }
        }
    });
    return false;
}

function cambiarEstatusUsuario(idUsuario, estatus){
    $.ajax({
        type:"post",
        data: "idUsuario=" + idUsuario + "&estatus=" + estatus,
        url: "../procesos/usuarios/extras/cambioEstatus.php",
        success:function(respuesta){
            respuesta = respuesta.trim();
            if (respuesta == 1) {
                // Actualizar la tabla de usuarios después de cambiar el estatus
                $('#tablaUsuarioLoad').load("usuarios/tablaUsuarios.php");
                Swal.fire(":D" , "Cambio de estatus con éxito!" , "success");    
            } else {
                Swal.fire(":c","Error al cambiar el estatus" + respuesta, "error");
            }
        }
    });
}

function eliminarUsuario(idUsuario, idPersona){
    Swal.fire({
        title: '¿Estás seguro de eliminar este usuario?',
        text: "Una vez eliminado no podrá ser recuperado!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡Sí, seguro!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type:"POST",
                data: "idUsuario=" + idUsuario + "&idPersona=" + idPersona,
                url:"../procesos/usuarios/crud/eliminarUsuario.php",
                success:function(respuesta) {
                    respuesta = respuesta.trim();
                    if (respuesta == 1) {
                        // Actualizar la tabla de usuarios después de eliminar uno
                        $('#tablaUsuarioLoad').load("usuarios/tablaUsuarios.php");
                        Swal.fire(":D" , "Usuario eliminado con éxito!" , "warning");    
                    } else {
                        Swal.fire(":c","Error al eliminar el usuario" + respuesta, "error");
                    }
                }
            });
        }
    });
    return false;
}

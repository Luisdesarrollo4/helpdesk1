// Función para realizar el inicio de sesión del usuario
function loginUsuario() {
    // Realizar una solicitud AJAX al archivo "loginUsuario.php"
    $.ajax({
        type: "POST",
        data: $('#frmLogin').serialize(), // Obtener los datos del formulario de inicio de sesión
        url: "procesos/usuarios/login/loginUsuario.php", // URL del archivo PHP que procesa el inicio de sesión
        success: function(respuesta) {
            respuesta = respuesta.trim(); // Eliminar espacios en blanco al inicio y final de la respuesta

            // Verificar la respuesta del servidor
            if (respuesta == 1) {
                // Redirigir al usuario a la página "inicio.php" en caso de inicio de sesión exitoso
                window.location.href = "vistas/inicio.php";
            } else {
                // Mostrar una notificación de error en caso de falla en el inicio de sesión
                Swal.fire(":c", "Error al entrar: " + respuesta, "error");
            }
        }
    });

    return false; // Evitar el envío tradicional del formulario
}

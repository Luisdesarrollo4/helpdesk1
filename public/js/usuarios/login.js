// Función para realizar el inicio de sesión del usuario
function loginUsuario() {
    // Realizar una solicitud AJAX al archivo "loginUsuario.php"
    $.ajax({
        type: "POST",
        data: $('#frmLogin').serialize(), // Obtener los datos del formulario de inicio de sesión
        url: "procesos/usuarios/login/loginUsuario.php", // URL del archivo PHP que procesa el inicio de sesión
        success: function(response) {
            // Parsea la respuesta JSON
            var data = JSON.parse(response);
            // Verifica el estado del inicio de sesión
            if (data.loginStatus === 1) {
                var area = data.area;
                if(area == 9){
                    window.location.href = "vistas/inicio.php";
                }
                if(area == 1){
                    window.location.href = "administradores/afinzamiento/vistas/inicio.php";
                }
                if(area == 2){
                    window.location.href = "administradores/analisis/vistas/inicio.php";
                }
                if(area == 3){
                    window.location.href = "administradores/cartera/vistas/inicio.php";
                }
                if(area == 4){
                    window.location.href = "administradores/comercial/vistas/inicio.php";
                }
                if(area == 5){
                    window.location.href = "administradores/contabilidad/vistas/inicio.php";
                }
                if(area == 6){
                    window.location.href = "administradores/desarrollo/vistas/inicio.php";
                }
                if(area == 7){
                    window.location.href = "administradores/gestion_humana/vistas/inicio.php";
                }
                if(area == 8){
                    window.location.href = "administradores/juridico/vistas/inicio.php";
                }
                // Haz lo que quieras con el valor "1" y el valor "area"
                console.log("Inicio de sesión exitoso");
                console.log("Área: " + area);
            } else {
                // Maneja el caso en el que el inicio de sesión no fue exitoso
                console.log("Inicio de sesión fallido");
            }
        },
        error: function(xhr, status, error) {
            // Maneja los errores si es necesario
            console.error(error);
        }
    });

    return false; // Evitar el envío tradicional del formulario
}

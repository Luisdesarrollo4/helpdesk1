<?php
// Verificar si el mensaje se recibió correctamente
if (isset($_POST['message'])) {
    $mensaje = $_POST['message'];

    // Incluir el archivo que contiene la clase de conexión
    require_once 'conexion.php';

    // Llamar a la función guardarMensaje() para guardar el mensaje en la base de datos
    if (guardarMensaje($mensaje)) {
        // Enviar una respuesta al cliente para indicar que el mensaje fue guardado exitosamente
        echo "Mensaje guardado exitosamente en la base de datos.";
    } else {
        echo "Error al guardar el mensaje en la base de datos.";
    }
} else {
    echo "Error: El mensaje no se recibió correctamente.";
}
?>

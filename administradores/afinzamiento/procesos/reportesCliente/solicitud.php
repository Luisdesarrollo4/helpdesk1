<?php
// Conexión a la base de datos (reemplaza con tus propios datos)
$servername = "localhost";
$username = "root";
$password = "root";
$database = "helpdesk1";

$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error en la conexión a la base de datos: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["idReporte"]) && isset($_POST["solucion"]) && isset($_POST["respuesta"]) && isset($_POST["estatus"])) {
        // Obtener datos del formulario
        $idReporte = $_POST["idReporte"];
        $solucion = $_POST["solucion"];
        $respuesta = $_POST["respuesta"];
        $motivoNo = isset($_POST["solicitud"]) ? $_POST["solicitud"] : null; // El campo motivoNo es opcional
        $estatus = $_POST["estatus"];

        // Realizar la inserción en la base de datos (esto puede variar dependiendo de tu esquema de base de datos)
        $sql = "INSERT INTO t_reportes_general (idReporte, solucion, respuesta, solicitud, estatus) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isssi", $idReporte, $solucion, $respuesta, $motivoNo, $estatus);

        if ($stmt->execute()) {
            echo 1; // Éxito
        } else {
            echo "Error al guardar en la base de datos: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Faltan datos requeridos.";
    }
} else {
    echo "Acceso denegado.";
}

// Cerrar la conexión a la base de datos
$conn->close();
?>

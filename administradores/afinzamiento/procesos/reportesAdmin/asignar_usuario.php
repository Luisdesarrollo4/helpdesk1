<?php
session_start();
include "../../clases/conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $con = new Conexion();
    $conexion = $con->conectar();

    $idReporte = $_POST['idReporte'];
    $idUsuario = $_POST['idUsuario'];
    echo 'ID de Reporte recibido: ' . $idReporte;
    echo 'ID de Usuario recibido: ' . $idUsuario;
    include "../../clases/Reportes.php";

    // Consulta SQL para actualizar el usuario asignado en el reporte
    $sql = "UPDATE t_reportes_general
            SET id_usuario_asignado = ?
            WHERE id_reporte_general = ?";

    $query = $conexion->prepare($sql);
    $query->bind_param('ii', $idUsuario, $idReporte);
    
    if ($query->execute()) {
        echo 'success'; // La asignación se realizó con éxito
    } else {
        echo 'error'; // Ocurrió un error en la asignación
    }

    $query->close();
    $conexion->close();
}
?>

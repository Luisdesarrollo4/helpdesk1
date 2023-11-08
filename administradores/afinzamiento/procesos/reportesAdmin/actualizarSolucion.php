<?php
session_start();

// Verificamos que se haya enviado el ID del reporte
if (isset($_POST['idReporte'])) {
    // Obtenemos los datos enviados desde el formulario
    $idReporte = $_POST['idReporte'];
    $solucion = $_POST['solucion'];
    $estatus = $_POST['estatus'];
    $idUsuario = $_SESSION['usuario']['id'];

    include "../../clases/Reportes.php";
    $Reportes = new Reportes();

    // Creamos un arreglo con los datos a actualizar
    $datos = array(
        'idReporte' => $idReporte,
        'solucion' => $solucion,
        'estatus' => $estatus,
        'idUsuario' => $idUsuario
    );

    // Ejecutamos el método actualizarSolucion solo para el reporte específico
    $respuesta = $Reportes->actualizarSolucion($datos);

    echo $respuesta;
} else {
    // Si no se envió el ID del reporte, mostramos un mensaje de error
    echo "Error: No se proporcionó el ID del reporte.";
}
?>


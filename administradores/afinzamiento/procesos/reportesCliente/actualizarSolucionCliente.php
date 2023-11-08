<?php
session_start();

// Verificamos que se haya enviado el ID del reporte
if (isset($_POST['idReporte'])) {
    // Obtenemos los datos enviados desde el formulario
    $idReporte = $_POST['idReporte'];
    $solucion = $_POST['solucion'];
    $estatus = $_POST['estatus'];
    $idUsuario = $_SESSION['usuario']['id'];

    // Agrega un echo para verificar que se estén recibiendo los datos correctamente
    echo "ID del Reporte: " . $idReporte . "<br>";
    echo "Solución: " . $solucion . "<br>";
    echo "Estatus: " . $estatus . "<br>";
    echo "ID del Usuario: " . $idUsuario . "<br>";

    include "../../clases/Reportes.php";

    
    $Reportes = new Reportes();

    // Creamos un arreglo con los datos a actualizar
    $datos = array(
        'idUsuario' => $idUsuario,
        'solucion' => $solucion,
        'estatus' => $estatus,
        'idReporte' => $idReporte
    );
        
    // Ejecutamos el método actualizarSolucion solo para el reporte específico
    $respuesta = $Reportes->actualizarSolucionCliente($datos);

    // Agrega un echo para verificar la respuesta
    echo "Respuesta del Servidor: " . $respuesta;
} else {
    // Si no se envió el ID del reporte, mostramos un mensaje de error
    echo "Error: No se proporcionó el ID del reporte.";
}
?>

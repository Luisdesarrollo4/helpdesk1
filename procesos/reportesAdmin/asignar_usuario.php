<?php
// Verificar si se reciben los datos esperados
if (isset($_POST['idUsuarioAsignado']) && isset($_POST['idReporte'])) {
    // Incluir el archivo de conexión a la base de datos
    include "../../clases/conexion.php";
    
    // Crear una instancia de la clase de conexión
    $con = new Conexion();
    $conexion = $con->conectar();

    // Obtener los datos enviados por la llamada AJAX
    $idUsuarioAsignado = $_POST['idUsuarioAsignado'];
    $idReporte = $_POST['idReporte'];

    // Actualizar la base de datos con el nuevo usuario asignado
    $sql = "UPDATE t_reportes_general SET id_usuario_asignado = ? WHERE id_reporte_general = ?";
    
    // Preparar la consulta
    $stmt = mysqli_prepare($conexion, $sql);
    
    // Vincular los parámetros
    mysqli_stmt_bind_param($stmt, "ii", $idUsuarioAsignado, $idReporte);
    
    // Ejecutar la consulta
    $resultado = mysqli_stmt_execute($stmt);

    // Verificar si la actualización fue exitosa
    if ($resultado) {
        // La asignación se realizó con éxito
        echo "Asignación exitosa";
    } else {
        // Hubo un error en la actualización
        echo "Fallo en la asignación";
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conexion);
} else {
    // Datos insuficientes o incorrectos enviados por la llamada AJAX
    echo "Datos incorrectos";
}
?>

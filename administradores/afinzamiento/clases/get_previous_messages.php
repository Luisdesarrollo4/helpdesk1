<?php
$mysqli = new mysqli('127.0.0.1', 'root', 'root', 'helpdesk1');

$query = "SELECT mensaje FROM chat_conversation WHERE id_reporte = 1"; // Reemplaza con la lógica adecuada para obtener el ID del reporte
$result = $mysqli->query($query);

$messages = [];
while ($row = $result->fetch_assoc()) {
    $messages[] = $row;
}

echo json_encode($messages);
?>

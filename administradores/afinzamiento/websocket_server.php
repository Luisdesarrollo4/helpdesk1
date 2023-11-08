<?php
use Ratchet\App;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
    

require __DIR__ . '/vendor/autoload.php'; // Asegúrate de que la ruta sea correcta

class WebSocketServer implements MessageComponentInterface
{
    
    protected $clients; 

    public function __construct()
    {
        $this->clients = new \SplObjectStorage();
    } 
    public function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);
        echo "Nueva conexión! (ID: {$conn->resourceId})\n";
    }
    
    public function onClose(ConnectionInterface $conn)
    {
        $this->clients->detach($conn);
        echo "Conexión cerrada (ID: {$conn->resourceId})\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "Error: {$e->getMessage()}\n";
        $conn->close();
    }
    public function onMessage(ConnectionInterface $from, $message)
    {
        // Ejemplo de inserción en la base de datos
        $mysqli = new mysqli('127.0.0.1', 'root', 'root', 'helpdesk1');
        $mensaje = $mysqli->real_escape_string($message);
        $id_reporte = 1; // Reemplaza con la lógica adecuada para obtener el ID del reporte
        $query = "INSERT INTO chat_conversation (id_reporte, mensaje) VALUES (?, ?)";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("is", $id_reporte, $mensaje);
        $stmt->execute();
        $stmt->close();
    
        // Envía el mensaje a todos los clientes conectados
        foreach ($this->clients as $client) {
            if ($from !== $client) { // Evita enviar el mensaje de regreso al remitente original
                $client->send($message);
            }
        }
        
    }
}


$server = new \Ratchet\App('localhost', 9090); // Puedes cambiar el puerto si es necesario
$server->route('/chat', new WebSocketServer(), array('*'));
$server->run();

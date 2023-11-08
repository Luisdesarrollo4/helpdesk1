<?php
    use Ratchet\App;
    use Ratchet\MessageComponentInterface;
    use Ratchet\ConnectionInterface;
        
    use Chat; 
    require __DIR__ . '/clases/chat.php';
    require 'vendor/autoload.php';
    class Chat implements MessageComponentInterface
    {
        protected $clients;

        public function __construct()
        {
            $this->clients = new \SplObjectStorage();
        }

        public function onOpen(ConnectionInterface $conn)
        {
            $this->clients->attach($conn);
            echo "Cliente conectado ({$conn->resourceId})\n";
        }

        public function onMessage(ConnectionInterface $from, $msg)
        {
            // Lógica para manejar los mensajes entrantes y distribuirlos a otros clientes
            foreach ($this->clients as $client) {
                if ($client !== $from) {
                    $client->send($msg);
                }
            }
        }

        public function onClose(ConnectionInterface $conn)
        {
            $this->clients->detach($conn);
            echo "Cliente desconectado ({$conn->resourceId})\n";
        }

        public function onError(ConnectionInterface $conn, \Exception $e)
        {
            echo "Error: {$e->getMessage()}\n";
            $conn->close();
        }
    }
    $server = new \Ratchet\App('localhost', 9090); // Puedes cambiar el puerto si es necesario
    $server->route('/chat', new WebSocketServer(), array('*'));
    $server->run();


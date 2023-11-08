
<!DOCTYPE html>
<html>
<head>
    <title>Chat</title>
    <link rel="stylesheet" href="chat/style.css"> <!-- Enlazar el archivo CSS externo -->
</head>
<body>
    <div class="chat-container">
        <div class="chat-header">Chat</div>
        <div class="chat-messages" id="chatMessages"></div>

        <input type="text" class="chat-input" id="messageInput" placeholder="Escribe tu mensaje..." />
        </br>
        <button class="chat-button" onclick="sendMessage()">Enviar</button>
        <!-- Agrega este botón para cerrar el chat -->
        <button class="close-button" onclick="closeChat()">Cerrar Chat</button>
    </div>
<script src="chat/chat.js"></script>
</body>
</html>


// Código para conectar al servidor WebSocket y enviar y recibir mensajes
const chatMessagesDiv = document.getElementById('chatMessages');
const messageInput = document.getElementById('messageInput');
const ws = new WebSocket('ws://localhost:9090/chat'); // Cambiar el puerto a 9090



ws.onopen = function(event) {
    chatMessagesDiv.innerHTML += '<div class="chat-message">¡Conexión establecida!</div>';
};
ws.onmessage = function(event) {
    const message = event.data;

    if (message.startsWith("")) {
        // Este mensaje se muestra cuando se envía un mensaje desde el cliente
        chatMessagesDiv.innerHTML += '<div class="chat-message">' + message + '</div>';
        chatMessagesDiv.scrollTop = chatMessagesDiv.scrollHeight; // Mantener el scroll hacia abajo
        return;
    }

    // Este mensaje se muestra cuando se recibe un mensaje del servidor
    chatMessagesDiv.innerHTML += '<div class="chat-message">' + message + '</div>';
    chatMessagesDiv.scrollTop = chatMessagesDiv.scrollHeight; // Mantener el scroll hacia abajo
};


function sendMessage() {
    // Obtener el mensaje ingresado por el usuario y aplicar trim()
    const message = messageInput.value.trim();

    // Verificar si el mensaje no está vacío
    if (message !== '') {
        // Enviar el mensaje al servidor WebSocket
        ws.send(message);

        // Limpiar el campo de mensaje en el chat
        messageInput.value = '';
    } else {
        // Mostrar mensaje de error si el campo está vacío
        alert('Por favor, ingresa un mensaje antes de enviar.');
    }
}
function closeChat() {
    // Ocultar el área de mensajes y el botón al hacer clic en el botón de cerrar chat
    const chatMessagesDiv = document.getElementById('chatMessages');
    const messageInput = document.getElementById('messageInput');
    const closeButton = document.querySelector('.close-button');
    
    chatMessagesDiv.style.display = 'none';
    messageInput.style.display = 'none';
    closeButton.style.display = 'none';
}

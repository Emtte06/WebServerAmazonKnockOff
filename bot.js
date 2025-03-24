const predefinedResponses = {
    'Order status': 'You can track your order using the link provided in your confirmation email.📦',
    'Returns': 'Send us an email 新创@hardware.cn at and we will send the return form to you within 72 business hours. Make sure to include your order number!📦',
    'Technical support': 'Our technical team will contact you within 24 hours.⌚',
    'default': 'Thank you for your feedback!😊'
};

function selectOption(optionText) {
    addMessage(optionText, 'user');
    const response = predefinedResponses[optionText] || predefinedResponses['default'];
    setTimeout(() => typeBotMessage(response), 500);
}

function sendMessage() {
    const input = document.getElementById('user-input');
    const message = input.value.trim();
    
    if (message) {
        addMessage(message, 'user');
        input.value = '';
        setTimeout(() => typeBotMessage(predefinedResponses['default']), 500);
    }
}

function addMessage(text, sender) {
    const chatMessages = document.getElementById('chat-messages');
    const messageDiv = document.createElement('div');
    messageDiv.className = `message ${sender}-message`;
    messageDiv.textContent = text;
    chatMessages.appendChild(messageDiv);
    chatMessages.scrollTop = chatMessages.scrollHeight;
}

function typeBotMessage(text) {
    const chatMessages = document.getElementById('chat-messages');
    const messageDiv = document.createElement('div');
    messageDiv.className = 'message bot-message typing-indicator';
    chatMessages.appendChild(messageDiv);
    
    let i = 0;
    const words = text.split(' ');
    const typingInterval = setInterval(() => {
        if (i < words.length) {
            messageDiv.textContent = words.slice(0, i+1).join(' ') + ' ';
            chatMessages.scrollTop = chatMessages.scrollHeight;
            i++;
        } else {
            clearInterval(typingInterval);
            messageDiv.classList.remove('typing-indicator');
            messageDiv.textContent = text;
        }
    }, 100);
}

document.getElementById('user-input').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        sendMessage();
    }
});
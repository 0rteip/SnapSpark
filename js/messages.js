function sendMessage() {
    let container = document.getElementById('chat-container');
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "utils/messages.php")
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            document.getElementById('message-text').value = "";
            displayMessages();
        }
    };
    xhr.send("message=" + document.getElementById('message-text').value + "&reciver=" + container.getAttribute('reciver'));
}

function displayMessages() {
    let container = document.getElementById('chat-container');
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "utils/messages.php");
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            console.log(this.responseText);
            const info = JSON.parse(this.responseText);
            let messages = info.messages;
            let msgs= "";
            messages.forEach(msg => {
                let class_extra = "";
                if (msg.sender === container.getAttribute('sender')) {
                    class_extra = "user-msg msg";
                } else {
                    class_extra = "reciver-msg msg";
                }
                msgs += 
                `
                <div class="${class_extra}">

                    <div class="text-message">${msg.testo}</div>
                    <div class="date-message">${msg.data}</div>
                </div>
                </div>
                `
            });
            document.getElementById('chat').innerHTML = msgs;
            let chatMessages = document.getElementById("chat");
            // Scrolla automaticamente verso l'ultimo messaggio al caricamento della pagina
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }
    };
    xhr.send("sender=" + container.getAttribute('sender') + "&reciver=" + container.getAttribute('reciver') + "&action=update");
}

displayMessages();


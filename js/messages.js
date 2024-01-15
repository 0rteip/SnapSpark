function sendMessage() {
    if (document.getElementById('message-text').value.length === 0) {
        return;
    }
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

function getCurrentMessages() {
    let messages = document.querySelectorAll('div.message-box');
    let result = [];
    messages.forEach(msg => {
        text = msg.getElementsByClassName('text-message')[0].innerHTML;
        date = msg.getElementsByClassName('date-message')[0].getAttribute('data');
        let tmp = {sender:msg.getAttribute("sender"),testo:text, data:date};
        result.push(tmp)
    })
    return result;
}

function displayMessages() {
    let container = document.getElementById('chat-container');
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "utils/messages.php");
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            const info = JSON.parse(this.responseText);
            let messages = info.messages;
            let msgs= "";
            if (JSON.stringify(messages) !== JSON.stringify(getCurrentMessages())) {
                let data = "";
                messages.forEach(msg => {
                    let class_extra = "";
                    if (msg.sender === container.getAttribute('sender')) {
                        class_extra = "user-msg msg ";
                    } else {
                        class_extra = "reciver-msg msg";
                    }
                    console.log(msg.data.substring(0,10))
                    if (data !== msg.data.substring(0,10)) {
                        data =  msg.data.substring(0,10);
                        msgs +=
                        `
                        <div class="new-day">${msg.data.substring(0,10)}</div>
                        `
                    }
                    msgs += 
                    `
                    <div class="message-box" sender="${msg.sender}">
                        <div class="${class_extra}">
                            <div class="text-message">${msg.testo}</div>
                            <div class="date-message" date="${msg.data}">${msg.data.substring(10, 16)}</div>
                        </div>
                    </div>
                    `
                });
                document.getElementById('chat-box').innerHTML = msgs;
                let chatMessages = document.getElementById("chat-box");
                // Scrolla automaticamente verso l'ultimo messaggio al caricamento della pagina
                chatMessages.scrollTop = chatMessages.scrollHeight;
                console.log("entro");
            }
        }
    };
    xhr.send("sender=" + container.getAttribute('sender') + "&reciver=" + container.getAttribute('reciver') + "&action=update");
    setTimeout('displayMessages()', 5000)
}
displayMessages();
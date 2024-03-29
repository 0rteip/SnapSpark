function sendMessage() {
    if (document.getElementById('message-text').value.length === 0) {
        return;
    }
    let container = document.getElementsByClassName('chat-container')[0].getAttribute('id').split("-")
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "utils/messages.php")
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            document.getElementById('message-text').value = "";
            displayMessages();
            notify(container[3], 'send')
        }
    };
    xhr.send("message=" + document.getElementById('message-text').value + "&reciver=" + container[3]);
}

function removeMessage(id) {
    let container = document.getElementsByClassName('chat-container')[0].getAttribute('id').split("-")
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "utils/messages.php")
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            document.getElementById('message-text').value = "";
            displayMessages();
            notify(container[3], 'removeMessage');
        }
    };
    xhr.send("id=" + id + "&action=delete");
}

function getCurrentMessages() {
    let messages = document.querySelectorAll('div.message-box');
    let result = [];
    messages.forEach(msg => {
        let text = msg.getElementsByClassName('text-message')[0].innerHTML;
        let date = msg.getElementsByClassName('date-message')[0].getAttribute('class').split(",")[1];
        let id = parseInt(msg.getAttribute('class').split("-")[2]);
        let tmp = { sender: msg.getAttribute('class').split("-")[3], testo: text, data: date, id: id };
        result.push(tmp)
    })
    return result;
}

function displayMessages() {
    let container = document.getElementsByClassName('chat-container')[0].getAttribute('id').split("-");
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "utils/messages.php");
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            const info = JSON.parse(this.responseText);
            let messages = info.messages;
            let msgs = "";

            if (JSON.stringify(messages) !== JSON.stringify(getCurrentMessages())) {
                let data = "";
                messages.forEach(msg => {
                    let class_extra = "";
                    if (msg.sender === container[2]) {
                        class_extra = "user-msg msg ";
                    } else {
                        class_extra = "reciver-msg msg";
                    }
                    if (data !== msg.data.substring(0, 10)) {
                        data = msg.data.substring(0, 10);
                        msgs +=
                            `
                        <div class="new-day">${msg.data.substring(0, 10)}</div>
                        `
                    }
                    msgs +=
                        `
                    <div class="message-box -${msg.id}-${msg.sender}">
                        <div class="${class_extra}">
                            <div class="text-message">${msg.testo}</div>
                            <div class="date-message ,${msg.data}">${msg.data.substring(10, 16)}</div>
                        </div>
                    </div>
                    `
                });
                document.getElementById('chat-box').innerHTML = msgs;
                let chatMessages = document.getElementById("chat-box");
                // Scrolla automaticamente verso l'ultimo messaggio al caricamento della pagina
                chatMessages.scrollTop = chatMessages.scrollHeight;
                msgs = document.querySelectorAll('div.message-box').forEach(msg => {
                    if (container[2] == msg.getAttribute('class').split("-")[3]) {
                        msg.addEventListener('contextmenu', function (event) {
                            event.preventDefault();
                            console.log("click");
                            $('#message-modal').modal('show');
                            const remove_bt = document.getElementById('remove-msg');
                            if (remove_bt !== null) {
                                // Clona l'elemento senza copiare gli event listener
                                const clonedElement = remove_bt.cloneNode(true);
                                // Sostituisci l'elemento originale con la sua copia
                                remove_bt.replaceWith(clonedElement);
                                clonedElement.addEventListener("click", function () {
                                    removeMessage(msg.getAttribute('class').split("-")[2]);
                                })
                            }

                        }, false);
                    }
                })
            }
        }
    };
    xhr.send("sender=" + container[2] + "&reciver=" + container[3] + "&action=update");
    setTimeout('displayMessages()', 2000)
}

const sendBt = document.getElementById('send-message-button');
if (sendBt != null) {
    sendBt.addEventListener("click", function () {
        sendMessage();
    })
}
displayMessages();

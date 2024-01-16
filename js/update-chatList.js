function showElenco(result) {
    let chats = ""
    result.chats.forEach(chat => {
        chats +=
            `
        <a href="chat.php?reciver=${chat.user}">
            <div class="user-card">
                    <img alt="" class="avatar me-3" id="chat-avatar" src="${result.avatar}avatar.png">
                    <div class="card custom-card borderless-card" id="chat-c">
                    <div class="info-chat">
                        <div class="user-name">${chat.user}</div>
                        <div class="card-text" data="${chat.data}">${chat.testo}</div>
                    </div>
                    </div>
            </div>
        </a>
        `
    })
    document.getElementById('chat-container').innerHTML = chats;
}
function getCurrentChats() {
    let chats = document.querySelectorAll('div.info-chat');
    let result = [];
    chats.forEach(chat => {
        let user = chat.querySelector('div.user-name').innerHTML;
        let info = chat.querySelector('div.card-text');
        let tmp = { user: user, testo: info.innerHTML, data: info.getAttribute('data') };
        result.push({ user: user, testo: info.innerHTML, data: info.getAttribute('data') });
    })
    return result;
}

function chatsUpdate() {

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "utils/search.php");
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function () {
        let result = JSON.parse(this.responseText);
        if (JSON.stringify(result.chats) !== JSON.stringify(getCurrentChats()) && document.getElementById('search-bar-chats').value.length === 0) {
            console.log('aggiorno')
            showElenco(result);
        }
    }
    xhr.send("string=" + "&type=3");
    setTimeout('chatsUpdate()', 1000);
}

function chatSearch(string, type) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "utils/search.php");
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function () {
        let result = JSON.parse(this.responseText);
        showElenco(result);
    }
    xhr.send("string=" + string + "&type=" + type);
}

chatsUpdate();

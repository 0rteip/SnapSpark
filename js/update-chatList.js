function showElenco(result) {
    let chats =""
    result.chats.forEach(chat => {
        chats += 
        `
        <a href="chat.php?reciver=${chat.user}">
            <div class="user-card">
                    <img alt="" class="avatar" id="chat-avatar" src="${result.avatar}avatar.png">
                    <div class="card custom-card borderless-card" id="chat-c">
                    <div class="info-card">
                        <div class="user-name">${chat.user}</div>
                        <div class="card-text">${chat.testo}</div>
                    </div>
                    </div>
            </div>
        </a>
        `
    })
    document.getElementById('chat-container').innerHTML = chats;
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
    xhr.send("string=" + string + "&type=" + type );
    setTimeout('chatSearch("", 3)',1000);
}
chatSearch("", 3);
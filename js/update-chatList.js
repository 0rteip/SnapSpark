function showElenco(result) {
    let chats = ""
    result.chats.forEach(chat => {
        let img = 'avatar.png';
        if (chat.img.length > 0) {
            img = chat.img;
        }
        chats +=
            `
        <a href="chat.php?reciver=${chat.user}">
            <div class="user-card mb-3">
                    <img alt="" class="avatar me-3" src="${result.avatar}${img}">
                    <div class="card custom-card borderless-card chat-c">
                    <div class="info-chat  _${img}_${chat.data}">
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
function getCurrentChats() {
    let chats = document.querySelectorAll('div.info-chat');
    let result = [];
    chats.forEach(chat => {
        let info = chat.getAttribute("class").split("_");
        let user = chat.querySelector('div.user-name').innerHTML;
        let data = info[2];
        let img = info[1];
        result.push({ user: user, testo: chat.getElementsByClassName('card-text')[0].innerHTML, data: data, img: img });
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
        if (JSON.stringify(result.chats) !== JSON.stringify(getCurrentChats()) && document.getElementsByClassName('search-bar')[0].value.length === 0) {
            console.log(JSON.stringify(result.chats))
            console.log(JSON.stringify(getCurrentChats()))
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
const newChatBt = document.getElementById('newChatBt');
if (newChatBt != null) {
    newChatBt.addEventListener("click", function () {
        location.href = 'new-chat.php';
    })
}
chatsUpdate();
const search = document.getElementsByClassName('search-bar')
if (search.length > 0) {
    search[0].addEventListener("keyup", function () {
        chatSearch(search[0].value, search[0].getAttribute('id').split(":-")[1])
    })
}

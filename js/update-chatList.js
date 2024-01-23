function showElenco(result) {
    let chats = ""
    result.chats.forEach(chat => {
        chats +=
            `
        <a href="chat.php?reciver=${chat.user}">
            <div class="user-card mb-3">
                    <img alt="" class="avatar me-3" src="${result.avatar}${chat.img}" />
                    <div class="custom-card">
                        <div class="info-chat  _${chat.img}_${chat.data}">
                            <p class="user-name mb-1 fw-bold">${chat.user}</p>
                            <p class="chat-message mb-0">${chat.testo}</p>
                        </div>
                    </div>
            </div>
        </a>
        `
    })
    document.getElementById('chat-container').innerHTML = chats;
    document.getElementsByClassName("user-card")[0].classList.add("first-chat");
}
function getCurrentChats() {
    let chats = document.querySelectorAll('div.info-chat');
    let result = [];
    chats.forEach(chat => {
        let info = chat.getAttribute("class").split("_");
        let user = chat.querySelector('p.user-name').innerHTML;
        let data = info[2];
        let img = info[1];
        result.push({ user: user, testo: chat.getElementsByClassName('chat-message')[0].innerHTML, data: data, img: img });
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
    setTimeout('chatsUpdate()', 10000);
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

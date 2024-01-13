console.log('search load');
function addUsers(result, type) {
    let users = ""
    result.users.forEach(user => {
        let link = "";
        switch (type) {
            case 0: link = `chat.php?reciver=${user.username}`;
                break;
            case 1: link = "user.php?username=" + user.username;
                break;
            case 2: link = "user.php?username=" + user.username;
                break;
        }
        users +=
            `
    <div class="card" style="width: 18rem;">
        <header class="card-header">
            <a href=${link} class="reciver" sender="${result.currentUser}" reciver="${user.username}") >
                <img src="${result.avatar}avatar.png" class="me-2" alt="" id="avatar">
                ${user.username}
            </a>
        </header>
    </div>
    `
    });
    //console.log(users);
    document.getElementsByClassName('search')[0].innerHTML = users;
}

function normalSearch(string, type) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "utils/search.php");
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function () {
        console.log(this.responseText);
        let result = JSON.parse(this.responseText);
        addUsers(result, type);
    }
    xhr.send("string=" + string + "&type=" + type);
}

function followerSearch(string, type, courrent, action) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "utils/search.php");
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function () {
        console.log(this.responseText);
        let result = JSON.parse(this.responseText);
        addUsers(result, type);
    }
    xhr.send("string=" + string + "&type=" + type + "&courrent=" + courrent + "&action=" + action);
}

function chatSearch(string, type) {
    if(string.length === 0) {
        window.location.reload(true);
        return;
    }
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "utils/search.php");
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function () {
        console.log(this.responseText);
        let result = JSON.parse(this.responseText);
        let chats =""
        result.chats.forEach(chat => {
            chats += 
            `
            <a href="chat.php?reciver=${chat.user}">
                <div class="user-card">
                    <img alt="" class="avatar" id="chat-avatar" src="${result.avatar}avatar.png">
                    <div class="user-info">
                        <div class="user-name">${chat.user}</div>
                        <div class="last-message">${chat.testo}</div>
                    </div>
                </div>
            </a>
            `
        })
        document.getElementById('chat-container').innerHTML = chats;
    }
    xhr.send("string=" + string + "&type=" + type );
}

function s() {
    if (location.hash.indexOf("create-chat")) {
        let links = document.getElementsByClassName("reciver");
        for (let i = 0; i<links.length; i++) {
            links[i].addEventListener("click", function() {
                sendDataChat(links[i].getAttribute("sender"), links[i].getAttribute("reciver"))
            })
        }
    }
}
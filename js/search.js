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
    <div class="user-card mb-3 pb-3">

            <a href=${link} class="reciver" sender="${result.currentUser}" reciver="${user.username}") >
                <img src="${result.avatar}avatar.png" class="avatar me-3" alt="" id="avatar" />
                ${user.username}
            </a>
    </div>
    `
    });
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

function s() {
    if (location.hash.indexOf("create-chat")) {
        let links = document.getElementsByClassName("reciver");
        for (let i = 0; i < links.length; i++) {
            links[i].addEventListener("click", function () {
                sendDataChat(links[i].getAttribute("sender"), links[i].getAttribute("reciver"))
            })
        }
    }
}

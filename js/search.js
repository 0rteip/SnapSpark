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
        let img = 'avatar.png';
        if (user.img.length > 0) {
            img = user.img;
        }
        users +=
            `
    <div class="card" style="width: 18rem;">
        <header class="card-header">
            <a href=${link} class="reciver") >
                <img src="${result.avatar}${img}" class="profile-avatar" alt="" id="avatar">
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

const search = document.getElementsByClassName('search-bar')
if (search.length >0) {
    search[0].addEventListener("keyup", function() {
        
        if (search[0].getAttribute('id').indexOf('follower')) {
            let data = search[0].getAttribute('id').split(":-");
            followerSearch(search[0].value, data[1], data[2], data[3])
        } else {
            normalSearch(search[0].value, search[0].getAttribute('id').split(":-")[1])
        }
    })
}
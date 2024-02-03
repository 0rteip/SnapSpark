function notify(reciver, type) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "utils/notification.php");
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send("action=send" + "&reciver=" + reciver + "&type=" + type);
}

function segui() {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "utils/segui.php");
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            const info = JSON.parse(this.responseText);
            init(info.followed, document.getElementById('current-user').innerHTML)
            document.getElementById('followers-number').innerHTML = info.follower.length;
        }
    };
    if (bt.getAttribute('value') === 'Follow') {
        xhr.send("action=Follow" + "&follow=" + document.getElementById('current-user').innerHTML);
    } else if (bt.getAttribute('value') === 'Unfollow') {
        xhr.send("action=Unfollow" + "&follow=" + document.getElementById('current-user').innerHTML);
    } else {
        console.log("send vuota");
        xhr.send("follow=" + document.getElementById('current-user').innerHTML);
    }
}

function init(array, username) {
    if (array.includes(username)) {
        bt.setAttribute('value', 'Unfollow');
        bt.innerHTML = "Unfollow";
    } else {
        bt.setAttribute('value', 'Follow');
        bt.innerHTML = "Follow";
    }
}

const bt = document.getElementById("follow-bt");
if (bt !== null) {
    bt.addEventListener("click", function () {
        segui();
        notify(document.getElementById('current-user').innerHTML, this.innerHTML)
    });
}

const chatbt = document.getElementById('message-bt');
if (chatbt !== null) {
    let courrent_user = document.getElementById('current-user').innerHTML;
    chatbt.addEventListener("click", function () {
        location.href = `chat.php?reciver=${courrent_user}`;
    })
}
segui();

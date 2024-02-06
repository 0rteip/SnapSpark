function segui() {
    let msg = "";
    if (bt.getAttribute('value') !== "") {
        msg = "action=" + bt.getAttribute('value') + "&";
    }
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

    xhr.send(msg + "follow=" + document.getElementById('current-user').innerHTML);
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
        notify(document.getElementById('current-user').innerHTML, this.innerHTML);
        segui();
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

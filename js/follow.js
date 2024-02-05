function notify(reciver, type) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "utils/notification.php");
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send("action=send" + "&reciver=" + reciver + "&type=" + type);
}

function segui() {
    let msg = "";
    if (bt.getAttribute('value') !== "") {
        msg = "action=" + bt.getAttribute('value') + "&";
    }
    worker.postMessage(msg + "follow=" + document.getElementById('current-user').innerHTML);
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

const worker = new Worker('js/worker.js');

segui();

worker.addEventListener('message', function (e) {
    const info = JSON.parse(e.data);
    init(info.followed, document.getElementById('current-user').innerHTML)
    document.getElementById('followers-number').innerHTML = info.follower.length;
});

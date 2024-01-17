console.log("follow load");
function notify(reciver, type) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "utils/notification.php");
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function () {
        console.log(this.responseText)
    }
    xhr.send("action=send" + "&reciver=" + reciver + "&type=" + type);
}

function segui() {
    console.log("follow load");
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "utils/segui.php");
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            console.log(this.responseText);
            const info = JSON.parse(this.responseText);
            init(info.followed, document.getElementById('current-user').innerHTML)
        }
    };
    if (bt.getAttribute('value') === 'Follow') {
        console.log('follow')
        xhr.send("action=Follow" + "&follow=" + document.getElementById('current-user').innerHTML);
    } else if(bt.getAttribute('value') === 'Unfollow') {
        console.log('unfollow')
        console.log(document.getElementById('current-user').innerHTML)
        xhr.send("action=Unfollow" + "&follow=" + document.getElementById('current-user').innerHTML);
    } else {
        console.log("send vuota");
        xhr.send();
    }
}

function init(array, username) {
    if (array.includes(username)) {
        notify(document.getElementById('current-user').innerHTML, bt.innerHTML)
        bt.setAttribute('value', 'Unfollow');
        bt.innerHTML = "Unfollow";
    } else {
        bt.setAttribute('value', 'Follow');
        bt.innerHTML = "Follow";
    }
    document.getElementById('followers-number').innerHTML = array.length;
}

const bt = document.getElementById("follow-bt");
if (bt !== null) {
    bt.addEventListener("click", function () {
        segui();
    });
}


const chatbt = document.getElementById('message-bt');
if (chatbt !== null) {
    let courrent_user = document.getElementById('current-user').innerHTML;
    chatbt.addEventListener("click", function() {
        location.href=`chat.php?reciver=${courrent_user}`;
    })
}
segui();
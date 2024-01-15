function segui() {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "utils/segui.php");
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            const info = JSON.parse(this.responseText);
            init(info.followed, document.getElementById('current-user').innerHTML)
        }
    };

    xhr.send();
}

function init(array, username) {
    if (array.includes(username)) {
        bt.setAttribute('value', 'Unfollow');
    } else {
        bt.setAttribute('value', 'Follow');
    }
}

const bt = document.getElementById("follow-bt");

bt.addEventListener("click", function () {
    if (bt.getAttribute('value') === 'Follow') {
        bt.setAttribute('value', 'Unfollow');
    } else {
        bt.setAttribute('value', 'Follow');
    }
});

segui();

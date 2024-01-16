function segui(username) {
    const formData = new FormData();
    formData.append("follow", bt.getAttribute('value'));
    formData.append("username", username);

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "utils/segui.php");
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    // xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            const info = JSON.parse(this.responseText);
            document.getElementById('followers-number').innerHTML = info.followers_number;
            init(info.followed, document.getElementById('current-user').innerHTML)
        }
    };
    if (bt.getAttribute('value') === 'Follow') {
        bt.setAttribute('value', 'Unfollow');
        xhr.send("action=Follow" + "&follow=" + document.getElementById('current-user').innerHTML);
    } else if(bt.getAttribute('value') === 'Unfollow') {
        bt.setAttribute('value', 'Follow');
        xhr.send("action=Unfollow" + "&follow=" + document.getElementById('current-user').innerHTML);
    } else {
        xhr.send();
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

bt.addEventListener("click", function () {
    segui();
});

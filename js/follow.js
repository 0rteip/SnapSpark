function segui() {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "utils/segui.php");
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            console.log(this.responseText);
            const info = JSON.parse(this.responseText);
            init(info.followed, document.getElementById('courrentUser').innerHTML, bt)
        }
    };

    xhr.send();
}
function init(array, username, bt) {
    console.log(username);
    if (array.includes(username)) {
        bt.setAttribute('value', 'unfollow');
        console.log('set follow');
    } else {
        bt.setAttribute('value', 'follow');
        console.log('set unfollow');
    }
}

const bt = document.getElementById("follow-bt");
if(bt !== null) {
    bt.addEventListener("click", function () {
        if (bt.getAttribute('value') === 'follow') {
            bt.setAttribute('value', 'unfollow');
        } else {
            bt.setAttribute('value', 'follow');
        }
    });
}
segui();

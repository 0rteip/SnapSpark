function returnText(type) {
    switch(type) {
        case 'send' : return " ti ha inviato un messaggio";
        case 'removeMessage' : return " ha eliminato un messaggio";
        case 'Follow' : return  " ha iniziato a seguirti";
        case 'Unfollow' : return  " ha smesso di seguirti";
    }
}
function showNotification() {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "utils/notification.php");
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function () {
        console.log(this.responseText)
        let result = JSON.parse(this.responseText);
        let notSec = document.getElementById("notication-section");
        let nots = "";
        result.notifications.forEach(not => {
            nots +=
            `
            <div class="card" style="width: 18rem;">
                <header class="card-header">
                    ${not.sender}${returnText(not.tipo)}
                </header>
            </div>
            `
        });
        console.log(nots)
        notSec.innerHTML = nots;
    }
    xhr.send("action=get");
}

function checkNewNotification() {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "utils/notification.php");
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function () {
        if (this.responseText === "true") {
            const notSec = document.getElementById("notication-section");
            if (notSec !== null) {
                showNotification();
            } else {
                if (confirm("Vuoi leggerle?") == true) {
                    
                }
            }
        }
    }
    xhr.send("action=check");
    setTimeout('checkNewNotification()', 1000);
}
checkNewNotification();
const notSec = document.getElementById("notication-section");
if (notSec !== null) {
    showNotification();
}

function showToast(toastBody) {
    const delay = 3000;
    let html =
        `
        <div class="toast align-items-center text-black bg-white custom-toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    ${toastBody}
                </div>
                <button type="button" class="btn-close btn-close-black me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    `;
    let toastElement = htmlToElement(html);
    let toastConainerElement = document.getElementById("toast-container");
    toastConainerElement.appendChild(toastElement);
    let toast = new bootstrap.Toast(toastElement, { delay: delay, animation: true });
    toast.show();
    setTimeout(() => toastElement.remove(), delay + 3000); // let a certain margin to allow the "hiding toast animation"
}

function htmlToElement(html) {
    let template = document.createElement('template');
    html = html.trim(); // Never return a text node of whitespace as the result
    template.innerHTML = html;
    return template.content.firstChild;
}

function returnText(type) {
    switch (type) {
        case 'send': return " ti ha inviato un messaggio";
        case 'removeMessage': return " ha eliminato un messaggio";
        case 'Follow': return " ha iniziato a seguirti";
        case 'Unfollow': return " ha smesso di seguirti";
    }
}

function showNotificationMessage(messages) {
    messages.forEach(not => {
        const user = document.getElementById("current-user");
        if (user && user.innerHTML === not.username && (not.tipo === "Follow" || not.tipo === "Unfollow")) {
            // todo: aggiornare il numero di follower
        }
        showToast(not.sen_user + returnText(not.tipo));
    });
}

function showNotification() {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "utils/notification.php");
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function () {
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
        const result = JSON.parse(this.responseText);
        if (result.news === "true") {
            const notSec = document.getElementById("notication-section");
            if (notSec) {
                showNotification();
            } else {
                showNotificationMessage(result.notifications);
            }
        }
    }
    xhr.send("action=check");
    setTimeout('checkNewNotification()', 2000);
}

checkNewNotification();

const notSec = document.getElementById("notication-section");
if (notSec !== null) {
    showNotification();
}

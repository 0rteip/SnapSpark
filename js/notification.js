function showToast(username, toastBody) {
    const delay = 3000;
    let html =
        `
        <div class="toast align-items-center text-black bg-white custom-toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <strong>${username}</strong>${toastBody}
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
        showToast(not.sen_user, returnText(not.tipo));
    });
}

function showNotification() {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "utils/notification.php");
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function () {
        let result = JSON.parse(this.responseText);
        let notSec = document.getElementById("show-section");
        let nots = "";
        result.notifications.forEach(not => {
            nots +=
                `
                <div class="user-card mb-3">
                    <div class="container-fluid p-0">
                        <div class="row row-cols-3 px-md-3 px-sm-2">
                            <div class="col-auto d-flex justify-content-start align-self-center">
                                <img alt="" class="mx-auto avatar" src="img/avatar/${not.profile_img}" />
                            </div>
                            <div class="col-auto text-start align-self-center me-auto">
                                    <p class="m-0"><strong>${not.sender}</strong>${returnText(not.tipo)}</p>
                                </div>
                                <div class="col-auto d-flex justify-content-end align-self-center ms-auto">
                                    <span tabindex="0" id="trash-can:-${not.id}" class="not-trash fa-solid fa-trash ms-2"></span>
                                </div>
                            </div>
                    </div>
                </div>
                `
        });
        console.log(result.notifications.length)
        if (result.notifications.length >0 && document.getElementById('deleteAllNotBt').hidden === true) {
            document.getElementById('deleteAllNotBt').hidden = false;
        }
        notSec.innerHTML = nots;
        Array.from(deleteNot).forEach(not => {
            not.addEventListener("click", function () {
                console.log("click")
                let xhr = new XMLHttpRequest();
                xhr.open("POST", "utils/notification.php");
                xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onload = function () {
                    showNotification();
                }
                xhr.send("action=del" + "&id=" + not.getAttribute('id').split(':-')[1]);
            })
        })
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
        const notSec = document.getElementById("show-section");
        if (result.news === "true") {
            if (notSec) {
                showNotification();
                document.getElementById('deleteAllNotBt').hidden = false;
            } else {
                showNotificationMessage(result.notifications);
            }
        } else {
            if (notSec && notSec.innerHTML == "") {
                notSec.innerHTML = "<p>Nessuna notifica</p>";
                document.getElementById('deleteAllNotBt').hidden = true;
            }
        }
    }
    xhr.send("action=check");
    setTimeout('checkNewNotification()', 2000);
}

const notSec = document.getElementById("show-section");
if (notSec) {
    showNotification();
    let deleteAllBt = document.getElementById('deleteAllNotBt');
    if (deleteAllBt !== null) {
        deleteAllBt.addEventListener("click", function () {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "utils/notification.php");
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function () {
                showNotification();
                document.getElementById('deleteAllNotBt').hidden = true
                notSec.innerHTML = "<p>Nessuna notifica</p>";
            }
            xhr.send("action=delAll");
        })
    }
}
checkNewNotification();


const deleteNot = document.getElementsByClassName("not-trash");

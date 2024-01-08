function getComments(user, post_id) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "utils/comments.php");
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');


    xhr.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            const response = JSON.parse(this.responseText);
            if (response.comments.length == 0) {
                document.getElementsByClassName("modal-body")[0].innerHTML =
                    `<div class="container text-center">
                    <h2>No comments yet.</h2>
                    <p>Be the first to comment!</p>
                    </div>`;
            }
            else {
                let comments = "";
                response.comments.forEach(comment => {
                    comments += `
                    <div class="row">
                        <div class="col-2">
                            <img src="img/avatar/avatar.png" alt="Profile picture" class="rounded-circle" width="50px" height="50px">
                        </div>
                        <div class="col-10">
                            <p class="text-left"><strong>${comment.user}</strong> ${comment.testo}</p>
                        </div>
                    </div>
                    `;
                });
                document.getElementsByClassName("modal-body")[0].innerHTML = comments;
            }
        }
    };

    xhr.send("action=get_comments" + "&u=" + user + "&i=" + post_id);
}

function enablePost() {
    const tarea = document.getElementById("commentArea");
    if (tarea.value.length > 0) {
        const btn = document.getElementById("postButton");
        btn.removeAttribute("disabled");
    }
    else {
        const btn = document.getElementById("postButton");
        btn.setAttribute("disabled", "");
    }
}

function postComment(user, post_id) {
    const comment = document.getElementById("commentArea");

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "utils/comments.php");
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            getComments(user, post_id);
        }
    };

    xhr.send("action=post_comments" + "&u=" + user + "&i=" + post_id + "&c=" + comment.value);

    comment.value = "";
    const btn = document.getElementById("postButton");
    btn.setAttribute("disabled", "");
}

const postModal = document.getElementById('postModal')
if (postModal) {
    postModal.addEventListener('show.bs.modal', event => {
        // Button that triggered the modal
        const button = event.relatedTarget
        // Extract info from data-bs-* attributes
        const username = button.getAttribute('data-bs-username')
        const id = button.getAttribute('data-bs-id')
        // Update the modal's content
        const modalButton = postModal.querySelector('#postButton');
        modalButton.setAttribute("onclick", "postComment(" + username + ", " + id + ")");
    })
}

function getComments(user, post_id) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "utils/comments.php");
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            const response = JSON.parse(this.responseText);
            if (response.comments.length == 0) {
                document.getElementById("message-modal-body").innerHTML =
                    `<div class="container text-center">
                    <h2>No comments yet.</h2>
                    <p>Be the first to comment!</p>
                    </div>`;
            }
            else {
                const user = response.user;
                let comments = "";
                response.comments.forEach(comment => {
                    let current_user = user == comment.user;
                    comments +=
                        `
                        <div class="container text-center m-0 mb-2 pb-2 single-comment">
                            <div class="row align-items-center justify-content-center">

                                <div class="col-1 p-0">
                                    <img alt="" class="mx-auto comment-profile-avatar" src="img/avatar/${comment.profile_img}" />
                                </div>

                                <div class="col-11">
                                    <div class="row ${current_user ? "row-cols-3" : "row-cols-2"} justify-content-center align-items-center">
                                        <div class="col-10">
                                            <p class="m-0 text-start"><strong>${comment.user}</strong> ${comment.testo}</p>
                                        </div>

                                        ` + (current_user ? `
                                        <div class="col-1 text-md-end d-grid px-0">
                                            <span id="comment-star-${comment.id}-${comment.user}" class="like-star mx-auto fa-${comment.like ? "solid liked-star" : "regular"} fa-star"></span>
                                        </div>
                                        <div class="col-1 text-md-end d-grid px-0">
                                            <span id="comment-trash-${comment.id}-${comment.user}" class="mx-auto comment-trash fa-solid fa-trash"></span>
                                        </div>
                                        ` : `
                                        <div class="col-2 text-md-end d-grid px-0">
                                            <span id="comment-star-${comment.id}-${comment.user}" class="like-star mx-auto fa-${comment.like ? "solid liked-star" : "regular"} fa-star"></span>
                                        </div>
                                        `) + `
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                });
                document.getElementById("message-modal-body").innerHTML = comments;
                response.comments.forEach(comment => {
                    document.getElementById("comment-star-" + comment.id + "-" + comment.user).addEventListener("click", event => likeComment(comment.user, comment.post_user, comment.post_id, comment.id));
                    const trash = document.getElementById("comment-trash-" + comment.id + "-" + comment.user)
                    if (trash) {
                        trash.addEventListener("click", event => removeComment(comment.user, comment.post_user, comment.post_id, comment.id));
                    }
                });
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

            comment.value = "";
            const btn = document.getElementById("postButton");
            btn.setAttribute("disabled", "");
        }
    };

    notify(user, "comment");

    xhr.send("action=post_comments" + "&u=" + user + "&i=" + post_id + "&c=" + comment.value);
}

function likeComment(comment_user, post_user, post_id, comment_id) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "utils/comments.php");
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            const star = document.getElementById("comment-star-" + comment_id + "-" + comment_user);
            star.classList.toggle("liked-star");
            star.classList.toggle("fa-regular");
            star.classList.toggle("fa-solid");
        }
    };

    xhr.send("action=like_comment" + "&cu=" + comment_user + "&pu=" + post_user + "&pid=" + post_id + "&cid=" + comment_id);
}

function removeComment(comment_user, post_user, post_id, comment_id) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "utils/comments.php");
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            getComments(post_user, post_id);
        }
    };

    xhr.send("action=delete_comment" + "&cu=" + comment_user + "&pu=" + post_user + "&pid=" + post_id + "&cid=" + comment_id);
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
        // Clona l'elemento senza copiare gli event listener
        const clonedElement = modalButton.cloneNode(true);
        // Sostituisci l'elemento originale con la sua copia
        modalButton.replaceWith(clonedElement);
        clonedElement.addEventListener("click", event => postComment(username, id));
    })
}

const tarea = document.getElementById("commentArea");
tarea.addEventListener("keyup", enablePost);

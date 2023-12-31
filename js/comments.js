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
                let i = 1;
                response.comments.forEach(comment => {
                    comments +=
                        `
                        <div class="container text-center m-0 mb-1">
                            <div class="row align-items-center justify-content-center">

                                <div class="col-1 p-0">
                                    <img alt="" id="avatar" class="mx-auto" src="img/avatar/avatar.png">
                                </div>

                                <div class="col-11">
                                    <div class="row align-items-center justify-content-center">

                                        <div class="col-11 col-sm-11">
                                            <p class="m-0 text-start"><strong>${comment.user}</strong> ${comment.testo}</p>
                                        </div>
                                        <div class="col-1 col-sm-1 p-0">
                                            <span id="comment-star-${i}" class="like-star mx-auto fa-${comment.like ? "solid liked-star" : "regular"} fa-star" onclick="likeComment('${comment.user}','${comment.post_user}',${comment.post_id},${i})"></span>
                                        </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                    i += 1;
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

            comment.value = "";
            const btn = document.getElementById("postButton");
            btn.setAttribute("disabled", "");
        }
    };

    xhr.send("action=post_comments" + "&u=" + user + "&i=" + post_id + "&c=" + comment.value);
}

function likeComment(comment_user, post_user, post_id, comment_id) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "utils/comments.php");
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            const star = document.getElementById("comment-star-" + comment_id);
            star.classList.toggle("liked-star");
            star.classList.toggle("fa-regular");
            star.classList.toggle("fa-solid");
        }
    };

    xhr.send("action=like_comment" + "&cu=" + comment_user + "&pu=" + post_user + "&pid=" + post_id + "&cid=" + comment_id);
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

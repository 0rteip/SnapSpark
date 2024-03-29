function likePost(post_user, post_id) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "utils/post.php");
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            const text = JSON.parse(this.responseText);
            const sparks = document.getElementById("sparks-num-" + post_user + "-" + post_id);

            if (text.likes > 0) {
                sparks.innerHTML = `
                <p id="sparks-${post_user}'-'${post_id}" class="card-text mx-auto text-start">
                    ${text.likes} ${text.likes === 1 ? "spark" : "sparks"}
                </p>
                `;
            } else {
                sparks.innerHTML = "";
            }
            const star = document.getElementById("post-star¬" + post_user + "¬" + post_id);

            if (!star.classList.contains("liked-star")) {
                notify(post_user, "like");
            }

            star.classList.toggle("liked-star");
            star.classList.toggle("fa-regular");
            star.classList.toggle("fa-solid");
        }
    };
    xhr.send("action=like_post" + "&u=" + post_user + "&id=" + post_id);
}

function deletePost(post_user, post_id) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "utils/post.php");
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            const post = document.getElementById("post-star¬" + post_user + "¬" + post_id);
            post.closest("article").remove();
        }
    };
    xhr.send("action=delete_post" + "&u=" + post_user + "&id=" + post_id);
}


const posts = document.getElementsByClassName("post-star");
Array.from(posts).forEach(element => {
    let els = element.getAttribute("id").split("¬");
    element.addEventListener("click", event => likePost(els[1], els[2]));
});

const comments = document.getElementsByClassName("post-comment");
Array.from(comments).forEach(element => {
    let user = element.getAttribute("data-bs-username");
    let id = element.getAttribute("data-bs-id");
    element.addEventListener("click", event => getComments(user, id));
});

const trashs = document.getElementsByClassName("post-trash");
Array.from(trashs).forEach(element => {
    let els = element.getAttribute("id").split("¬");
    element.addEventListener("click", event => deletePost(els[1], els[2]));
});

function likePost(post_user, post_id) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "utils/post.php");
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            const text = JSON.parse(this.responseText);

            const sparks = document.getElementById("sparks-num");
            if (text.likes > 0) {
                sparks.innerHTML = `
                <p id="sparks-${post_user}'-'${post_id}" class="card-text mx-auto text-start">
                    ${text.likes} ${text.likes === 1 ? "spark" : "sparks"}
                </p>
                `;
            } else {
                sparks.innerHTML = "";
            }


            console.log(text);
            const star = document.getElementById("post-star-" + post_user + "-" + post_id);

            star.classList.toggle("liked-star");
            star.classList.toggle("fa-regular");
            star.classList.toggle("fa-solid");

            const likes = document.getElementById("sparks-" + post_user + "-" + post_id);
            likes.innerHTML = text.likes;
        }
    };

    xhr.send("action=like_post" + "&u=" + post_user + "&id=" + post_id);
}

function hasPostLiked(post_user, post_id) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "utils/post.php");
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            const text = JSON.parse(this.responseText);

            if (text.liked) {
                const star = document.getElementById("post-star-" + post_user + "-" + post_id);

                star.classList.toggle("liked-star");
                star.classList.toggle("fa-regular");
                star.classList.toggle("fa-solid");
            }
        }
    };

    xhr.send("action=check_like" + "&u=" + post_user + "&id=" + post_id);
}

for (const footer of document.getElementsByClassName("card-footer")) {
    const element = footer.getElementsByClassName("fa-star")[0];
    const id = element.getAttribute("post_id");
    const user = element.getAttribute("user");
    hasPostLiked(user, id);
}

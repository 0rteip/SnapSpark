<?php foreach ($templateParams["posts"] as $post) : ?>
    <article class="card">

        <header class="card-header">
            <a href="user.php?username=<?php echo $post["username"]; ?>">
                <img src="<?php echo AVATAR_FOLDER . "avatar.png"; ?>" class="me-2" alt="" id="avatar">
                <?php echo $post["username"]; ?> - <?php echo $post["data"] ?>
            </a>
        </header>

        <img class="card-img rounded-0" src="<?php echo POST_FOLDER . $post["file"]; ?>" alt="">

        <div class="card-body">
            <p class="card-text">
                <?php echo $post["descrizione"]; ?>
            </p>
        </div>

        <footer class="card-footer">
            <p class="card-text mx-auto">
                <?php echo $post["spark"]; ?>
                <i class="fa-regular fa-star"></i>
                <i class="fa-regular fa-comment"></i>
            </p>
        </footer>

    </article>

<?php endforeach; ?>

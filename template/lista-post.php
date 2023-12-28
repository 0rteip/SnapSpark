<?php foreach ($templateparams["posts"] as $post) : ?>
    <article class="card col-11 mx-auto">

        <header class="card-header">
            <img src="<?php echo AVATAR_FOLDER . "avatar.png"; ?>" class="me-2" alt="">
            <?php echo $post["username"]; ?> - <?php echo $post["data"] ?>
        </header>

        <img src="<?php echo POST_FOLDER . $post["file"]; ?>" alt="">
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

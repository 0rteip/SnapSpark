<section >
        <?php foreach ($templateParams["users"] as $user) : ?>
            <div class="card" style="width: 18rem;">
                <header class="card-header">
                    <a href="user.php?username=<?php echo $user["username"]; ?>">
                        <img src="<?php echo AVATAR_FOLDER . "avatar.png"; ?>" class="me-2" alt="" id="avatar">
                        <?php echo $user["username"]; ?> - <?php echo $post["data"] ?>
                    </a>
                </header>
            </div>
        <?php endforeach; ?>
</section>
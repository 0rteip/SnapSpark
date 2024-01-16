<section class="search">
    <?php foreach ($templateParams["users"] as $user) : ?>
        <div class="card" style="width: 18rem;">
            <header class="card-header">
                <a href="user.php?username=<?php echo $user["username"]; ?>">
                    <img src="<?php echo AVATAR_FOLDER . $user["img"] ?>" class="avatar" alt="" id="avatar" />
                    <?php echo $user["username"]; ?>
                </a>
            </header>
        </div>
    <?php endforeach; ?>
</section>

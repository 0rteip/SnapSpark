<?php foreach ($templateParams["users"] as $user) : ?>
    <a href="user.php?username=<?php echo $user["username"]; ?>" target="_self">
        <div class="user-card mb-3">
            <img src="<?php echo AVATAR_FOLDER . $user["img"] ?>" class="avatar me-3" alt="" />

            <div class="card custom-card borderless-card chat-c">
                <div class="info-chat">
                    <div class="card-text"><?php echo $user["username"]; ?></div>
                </div>
            </div>

        </div>
    </a>
<?php endforeach; ?>

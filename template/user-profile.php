<div class="container text-center mb-3">
    <div class="row row-cols-2">
        <div class="col-2 text-middle align-middle">
            <img src="<?php echo AVATAR_FOLDER . $templateParams["info"]["profile_img"]; ?>" class="profile-avatar" alt="" />
        </div>
        <div class="col-9">
            <div class="container text-center">
                <div class="row row-cols-1">
                    <div id="current-user" class="col fw-bolder"><?php echo $templateParams["username"]; ?></div>
                    <div class="col"><?php echo $templateParams['info']["biografia"]; ?></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container text-center mb-3">
    <div class="row row-cols-3">
        <div class="col">
            <div class="container text-center">
                <div class="row row-cols-1">
                    <div class="col"><?php echo count($templateParams["posts"]); ?></div>
                    <div class="col">Post</div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="container text-center">
                <a href="info-follower.php?username=<?php echo $templateParams["username"] ?>&action=follower">
                    <div class="row row-cols-1">
                        <div class="col"><?php echo count($templateParams["follower"]); ?></div>
                        <div class="col">Follower</div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col">
            <div class="container text-center">
                <a href="info-follower.php?username=<?php echo $templateParams["username"] ?>&action=followed">

                    <div class="row row-cols-1">
                        <div class="col"><?php echo count($templateParams["followed"]); ?></div>
                        <div class="col">Followed</div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="container text-center mb-3">
    <div class="row row-cols-2">
        <?php if ($_SESSION['username'] !== $templateParams['username']) : ?>
            <div class="col" id="follow-button">
                <form action="" method="POST">
                    <input class="btn btn-primary" type="submit" value="" name="follow" id="follow-bt">
                </form>
            </div>
            <div class="col">
                <button class="btn btn-primary" onclick="location.href='chat.php?reciver=<?php echo $templateParams['username'] ?>'" value="" name="message" id="message-bt">Messaggia</button>
            </div>
            <script src="js/follow.js"></script>
        <?php endif; ?>
    </div>
</div>

<?php require_once "template/lista-post.php"; ?>

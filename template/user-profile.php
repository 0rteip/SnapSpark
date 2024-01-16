<div class="container text-center mb-3">
    <div class="row row-cols-2">
        <div class="col-sm-3 col-md-2 text-middle align-middle">
            <input name="profile-img" type="file" id="profile-img" accept="image/jpeg" required />
            <img src="<?php echo AVATAR_FOLDER . $templateParams["info"]["profile_img"]; ?>" class="profile-avatar" alt="" style="<?php echo $templateParams['username'] === $_SESSION['username'] ? 'cursor: pointer;' : ''; ?>" />
        </div>
        <div class="col-sm-9 col-md-10 my-auto">
            <div class="container text-center">
                <div class="row row-cols-1">
                    <h2 id="current-user" class="col fw-bolder"><?php echo $templateParams["username"]; ?></h2>
                    <div class="col"><?php echo $templateParams['info']["biografia"]; ?></div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container text-center mb-3 p-3" id="user-info" style="<?php echo $templateParams['username'] !== $_SESSION['username'] ? 'border-bottom: 1px solid #ddd' : ''; ?>">
    <div class="row row-cols-3">
        <div class="col">
            <div class="container text-center">
                <div class="row row-cols-1">
                    <div class="col mb-1"><?php echo count($templateParams["posts"]); ?></div>
                    <div class="col">Post</div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="container text-center">
                <a href="info-follower.php?username=<?php echo $templateParams["username"] ?>&action=follower">
                    <div class="row row-cols-1">
                        <div class="col mb-1" id="followers-number"><?php echo count($templateParams["follower"]); ?></div>
                        <div class="col">Follower</div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col">
            <div class="container text-center">
                <a href="info-follower.php?username=<?php echo $templateParams["username"] ?>&action=followed">

                    <div class="row row-cols-1">
                        <div class="col mb-1"><?php echo count($templateParams["followed"]); ?></div>
                        <div class="col">Followed</div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<?php if ($_SESSION['username'] !== $templateParams['username']) : ?>
    <div class="container text-center mb-3">
        <div class="row row-cols-2">
            <div class="col" id="follow-button">
                <?php if (!checkFollow($_SESSION["username"], $templateParams['follower'])) : ?>
                    <button class="btn btn-primary" type="submit" value="Unfollow" name="follow" id="follow-bt" onclick=segui("<?php echo $templateParams['username']; ?>")>Unfollow</button>
                <?php else : ?>
                    <button class="btn btn-primary" type="submit" value="Follow" name="follow" id="follow-bt" onclick=segui("<?php echo $templateParams['username']; ?>")>Follow</button>
                <?php endif; ?>
            </div>
            <div class="col">
                <button class="btn btn-primary" onclick="location.href='chat.php?reciver=<?php echo $templateParams['username'] ?>'" value="" name="message" id="message-bt">Messaggia</button>
            </div>
            <script src="js/follow.js"></script>
        </div>
    </div>
<?php else : ?>
    <?php require_once "template/cropper.php"; ?>
    <script src="js/user-profile-change.js"></script>
<?php endif; ?>

<?php require_once "template/lista-post.php"; ?>

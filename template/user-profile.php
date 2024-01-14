<div class="container text-center">
    <div class="row">
        <div class="col">
            <ul>
                <li>
                    <img src="<?php echo AVATAR_FOLDER . "avatar.png"; ?>" class="me-2" alt="" id="avatar">
                </li>
                <li>
                    <label id='courrentUser'><?php echo $templateParams['username'] ?></label>
                </li>
            </ul>
        </div>
        <div class="col">
            <ul>
                <li>
                    <label>
                        <?php echo count($templateParams["posts"]) ?>
                    </label>
                </li>
                <li>
                    <label> Post</label>
                </li>
            </ul>
        </div>
        <div class="col">
            <a href="info-follower.php?username=<?php echo $templateParams["username"] ?>&action=follower">
                <ul>
                    <li>
                        <label>
                            <?php echo count($templateParams['follower']) ?>
                        </label>
                    </li>
                    <li>
                        <label> Follower</label>
                    </li>
                </ul>
            </a>
        </div>
        <div class="col">
            <a href="info-follower.php?username=<?php echo $templateParams["username"] ?>&action=followed">
                <ul>
                    <li>
                        <label>
                            <?php echo count($templateParams['followed']) ?>
                        </label>
                    </li>
                    <li>
                        <label>Seguiti</label>
                    </li>
                </ul>
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-4">
        <div class="card">
            <div class="card-body">
                <p class="card-text">
                    <?php if (count($templateParams['bio']) > 0) {
                        echo $templateParams['bio'][0]['biografia'];
                    } ?>
                </p>
            </div>
        </div>
    </div>
    <?php if ($_SESSION['username'] !== $templateParams['username']) { ?>
                <div class="col-1" id="follow-button">
                    <form action="" method="POST">
                        <input class="btn btn-primary" type="submit" value="" name="follow" id="follow-bt">
                    </form>
                </div>
                <div class="col-1">
                    <button class="btn btn-primary" onclick="location.href='chat.php?reciver=<?php echo $templateParams['username'] ?>'" value="" name="message" id="message-bt">Messaggia</button>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
<div class="row">
    <div class="d-flex justify-content-center">
        <?php foreach ($templateParams["posts"] as $post): ?>
            <div class="card" style="width: 10rem;" id="profile">
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
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script src="js/follow.js"></script>
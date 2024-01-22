<label for="search-bar:-0" class="visually-hidden">Search a user</label>
<input id="search-bar:-0" class="form-control search-bar bg-main-color-subtle" name="search" type="search" placeholder="Search" aria-label="Search">

<div class="search">
    <?php foreach ($templateParams['sug'] as $sug) : ?>
        <a href="chat.php?reciver=<?php echo $sug['username'] ?>" class="reciver" sender="<?php echo $_SESSION['username'] ?>" reciver="<?php echo $sug['username'] ?>">
            <div class="user-card mb-3">
                <img src="<?php echo AVATAR_FOLDER . $sug['img'] ?>" class="avatar me-3" alt="" />

                <div class="custom-card">
                    <div class="info-chat">
                        <p class="user-name mb-1 fw-bold"><?php echo $sug['username'] ?></p>
                    </div>
                </div>
            </div>
        </a>
    <?php endforeach; ?>
</div>
<script src="js/search.js"></script>

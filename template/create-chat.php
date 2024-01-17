<input id="search-bar:-0" class="search-bar bg-main-color-subtle" name="search" type="search" placeholder="Search" aria-label="Search">

<section class="search">
    <?php foreach ($templateParams['sug'] as $sug) : ?>
        <div class="card" style="width: 18rem;">
            <header class="card-header">
                <a href="chat.php?reciver=<?php echo $sug['username'] ?>" class="reciver" sender="<?php echo $_SESSION['username'] ?>" reciver="<?php echo $sug['username'] ?>">
                    <img src="<?php echo AVATAR_FOLDER . $sug['img'] ?>" class="avatar" alt="" />
                    <?php echo $sug['username'] ?>
                </a>
            </header>
        </div>
    <?php endforeach; ?>
</section>
<script src="js/search.js"></script>

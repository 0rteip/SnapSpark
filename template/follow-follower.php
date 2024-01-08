<!-- <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
    <input type="radio" class="btn-check" name="btnradio" id="follower" autocomplete="off"  <?php echo checkRadio($_GET['action'], "follower")?>> 
    <label class="btn btn-outline-primary" for="follower">Follower</label>

    <input type="radio" class="btn-check" name="btnradio" id="followed" autocomplete="off"  <?php echo checkRadio($_GET['action'], "followed")?>>
    <label class="btn btn-outline-primary" for="followed">Follow</label>
</div>

<section class="follower" <?php echo hideSection($_GET['action'], "follower")?>>
        <?php foreach ($templateParams["follower"] as $user) : ?>
            <div class="card" style="width: 18rem;">
                <header class="card-header">
                    <a href="user.php?username=<?php echo $user["follower"]; ?>">
                        <img src="<?php echo AVATAR_FOLDER . "avatar.png"; ?>" class="me-2" alt="" id="avatar">
                        <?php echo $user["follower"]; ?> - <?php echo $post["data"] ?>
                    </a>
                </header>
            </div>
        <?php endforeach; ?>
</section>

<section class="followed" <?php echo hideSection($_GET['action'], "followed")?>>
        <?php foreach ($templateParams["followed"] as $user) : ?>
            <div class="card" style="width: 18rem;">
                <header class="card-header">
                    <a href="user.php?username=<?php echo $user["user"]; ?>">
                        <img src="<?php echo AVATAR_FOLDER . "avatar.png"; ?>" class="me-2" alt="" id="avatar">
                        <?php echo $user["user"]; ?> - <?php echo $post["data"] ?>
                    </a>
                </header>
            </div>
        <?php endforeach; ?>
</section>

<script src="js/prova.js"></script> -->
<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link <?php echo checkRadio($templateParams['action'], 'follower') ?>" aria-current="page" href="info-follower.php?username=<?php echo $username?>&action=follower">Follower</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php echo checkRadio($templateParams['action'], 'followed') ?>" href="info-follower.php?username=<?php echo $username?>&action=followed">Flollowed</a>
  </li>
</ul>
<?php require("search-users.php");?>

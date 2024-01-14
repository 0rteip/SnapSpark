<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link <?php echo checkRadio($templateParams['action'], 'follower') ?>" aria-courrent="page" href="info-follower.php?username=<?php echo $username ?>&action=follower">Follower</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php echo checkRadio($templateParams['action'], 'followed') ?>" href="info-follower.php?username=<?php echo $username ?>&action=followed">Flollowed</a>
  </li>
</ul>
<input class="form-control bg-main-color-subtle" name="search" type="search" placeholder="Search" aria-label="Search" onkeyup="followerSearch(this.value, 2,  '<?php print($templateParams['username']); ?>' , '<?php print($templateParams['action']); ?>' )">

<section class="search">
  <?php require("list-username.php"); ?>
</section>
<script src="js/search.js"></script>

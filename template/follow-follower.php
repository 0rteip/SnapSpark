<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link <?php echo checkRadio($templateParams['action'], 'follower') ?>" aria-courrent="page" href="info-follower.php?username=<?php echo $username ?>&action=follower">Follower</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php echo checkRadio($templateParams['action'], 'followed') ?>" href="info-follower.php?username=<?php echo $username ?>&action=followed">Flollowed</a>
  </li>
</ul>
<input id="search-follower:-2:-<?php print($templateParams['username']); ?>:-<?php print($templateParams['action']); ?>" class="search-bar bg-main-color-subtle" name="follower-search" type="search" placeholder="Search" aria-label="Search" >

<section class="search">
  <?php require("list-username.php"); ?>
</section>
<script src="js/search.js"></script>

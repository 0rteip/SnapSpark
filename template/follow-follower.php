<ul class="nav nav-tabs follow-tabs">
  <li class="nav-item">
    <a class="nav-link <?php echo checkRadio($templateParams['action'], 'follower') ?>" href="info-follower.php?username=<?php echo $username ?>&action=follower" target="_self">Follower</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php echo checkRadio($templateParams['action'], 'followed') ?>" href="info-follower.php?username=<?php echo $username ?>&action=followed" target="_self">Followed</a>
  </li>
</ul>

<label for="search-user" class="visually-hidden">Search user</label>
<input id="search-follower:-2:-<?php print($templateParams['username']); ?>:-<?php print($templateParams['action']); ?>" class="search-bar bg-main-color-subtle" name="follower-search" type="search" placeholder="Search" aria-label="Search">

<div class="search">
  <?php require("list-username.php"); ?>
</div>

<script src="js/search.js"></script>

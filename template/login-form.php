<?php if (isset($templateParams["errorelogin"])) : ?>
  <p class="text-danger"><?php echo $templateParams["errorelogin"]; ?></p>
<?php endif; ?>

<form action="login.php" method="POST">
  <div class="col mb-4">
    <label for="mail" class="form-label">Email address Or Username</label>
    <input type="text" class="form-control" id="mail" name="mail" placeholder="name@example.com or yourUserName">
  </div>

  <div class="col mb-4">
    <label for="password" class="form-label">Password</label>
    <input type="password" id="password" class="form-control" name="password">
  </div>

  <div class="col-12">
    <button class="btn btn-primary me-2" type="submit">Login</button>
    <a href="modify-create-account.php?action=0">Subscribe</a>
  </div>

</form>

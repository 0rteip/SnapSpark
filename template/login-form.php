<?php if(isset($templateParams["errorelogin"])): ?>
            <p><?php echo $templateParams["errorelogin"]; ?></p>
            <?php endif; ?>
<form action="#" method="POST">
    <div class="col mb-4">
      <label for="mail" class="form-label">Email address</label>
      <input type="email" class="form-control" id="mail" name="mail" placeholder="name@example.com">
    </div>
    
    <label for="password" class="form-label">Password</label><input type="password" id="password" class="form-control" name="password">
    <div class="col-12">
        <button class="btn btn-primary" type="submit">Submit form</button>
        <a href="new-account.php">Inscriviti se non hai un account!</a>
    </div>
</form>

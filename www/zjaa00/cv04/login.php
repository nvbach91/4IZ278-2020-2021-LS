<?php require "partials/header.php"; ?>

<main>
  
  <h1>Login</h1>
  <form class="form-signup" method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
    
  <?php require "login_validation.php"; ?>
      
    <div class="form-group">
      <label>Email*</label>
      <input class="form-control" name="email" value="<?= isset($email) ? $email : "" ?>">
      <small class="text-muted">Example: example@gmail.com</small>
    </div>
    <div class="form-group">
      <label>Password*</label>
      <input type="password" class="form-control" name="password" value="">
      <input type="checkbox">
      <small>Show Password</small>
    </div>
    <button class="btn btn-primary" type="submit">Submit</button>
  </form>

</main>

<?php require "partials/footer.php"; ?>
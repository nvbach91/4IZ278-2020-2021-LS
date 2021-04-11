<?php include "partials/header.php"; ?>

  <form class="form-signup" method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
    <h1>Registration</h1>

<?php require "registration_validation.php"; ?>

    <div class="form-group">
      <label>Name*</label>
      <input class="form-control" name="name" value="<?= isset($name) ? $name : "" ?>">
    </div>
    <div class="form-group">
      <label>Email*</label>
      <input class="form-control" name="email" value="<?= isset($email) ? $email : "" ?>">
      <small class="text-muted">Example: example@gmail.com</small>
    </div>
    <div class="form-group">
      <label>Password*</label>
      <input type="password" class="form-control" name="password" value="<?= isset($password) ? $password : "" ?>">
      <input type="checkbox">
      <small>Show Password</small>
    </div>
    <div class="form-group">
      <label>Confirm password*</label>
      <input type="password" class="form-control" name="confirm" value="<?= isset($confirm) ? $confirm : "" ?>">
      <input type="checkbox">
      <small>Show Password</small>
    </div>
    <button class="btn btn-primary" type="submit">Submit</button>
  </form>

<?php require "partials/footer.php"; ?>
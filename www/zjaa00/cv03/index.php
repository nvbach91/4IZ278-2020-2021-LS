<?php require "partials/header.php"; ?>


  <form class="form-signup" method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
  <h1>Form</h1>

  <?php require 'partials/validation.php'; ?>

  <div class="form-group">
    <label>Name*</label>
    <input class="form-control" name="name" value="<?= isset($name) ? $name : "" ?>">
  </div>
  <div class="form-group">
    <label>Gender*</label>
    <select class="form-control" name="gender">
      <option hidden value<?= (!isset($gender)) ? " selected" : "" ?>></option>
      <option value="Male" <?= (isset($gender) && $gender == "Male") ? " selected" : "" ?>>Male</option>
      <option value="Female" <?= (isset($gender) && $gender == "Female") ? " selected" : "" ?>>Female</option>
    </select>
  </div>
  <div class="form-group">
    <label>Email*</label>
    <input class="form-control" name="email" value="<?= isset($email) ? $email : "" ?>">
    <small class="text-muted">Example: example@gmail.com</small>
  </div>
  <div class="form-group">
    <label>Phone*</label>
    <input class="form-control" name="phone" value="<?= isset($phone) ? $phone : "" ?>">
    <small class="text-muted">Example: +421841147239 or 0841147239</small>
  </div>
  <div class="form-group">
    <label>Avatar URL*</label>

    <?php if (isset($avatar) && filter_var($avatar, FILTER_VALIDATE_URL)) : ?>
      <div class="avatar" style="background-image: url('<?= $avatar ?>');"></div>
    <?php endif ?>

    <input class="form-control" name="avatar" value="<?= isset($avatar) ? $avatar : "" ?>">
    <small class="text-muted">Example: https://eso.vse.cz/~zjaa00/cv03/img/homer.png</small>
  </div>
  <div class="form-group">
    <label>Game*</label>
    <input class="form-control" name="game" value="<?= isset($game) ? $game : "" ?>">
    <small class="text-muted">Example: Bingo!</small>
  </div>
  <div class="form-group">
    <label>Number of cards*</label>
    <input class="form-control" name="cards" value="<?= isset($cards) ? $cards : "" ?>">
  </div>
  <button class="btn btn-primary" type="submit">Submit</button>
</form>


<?php require "partials/footer.php"; ?>
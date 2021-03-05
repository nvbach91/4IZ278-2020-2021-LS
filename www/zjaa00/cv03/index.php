<?php require "partials/header.php"; ?>


<?php if (empty($_POST)) : ?>

  <form class="form-signup" method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
    <h1>Form</h1>
    <div class="form-group">
      <label>Name*</label>
      <input class="form-control" name="name" value="">
    </div>
    <div class="form-group">
      <label>Gender*</label>
      <select class="form-control" name="gender">
        <option hidden selected value></option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
      </select>
    </div>
    <div class="form-group">
      <label>Email*</label>
      <input class="form-control" name="email" value="">
      <small class="text-muted">Example: example@gmail.com</small>
    </div>
    <div class="form-group">
      <label>Phone*</label>
      <input class="form-control" name="phone" value="">
      <small class="text-muted">Example: +421841147239 or 0841147239</small>
    </div>
    <div class="form-group">
      <label>Avatar URL*</label>
      <input class="form-control" name="avatar" value="">
      <small class="text-muted">Example: https://eso.vse.cz/~zjaa00/cv03/img/homer.png</small>
    </div>
    <div class="form-group">
      <label>Game*</label>
      <input class="form-control" name="game" value="">
      <small class="text-muted">Example: Bingo!</small>
    </div>
    <div class="form-group">
      <label>Number of cards*</label>
      <input class="form-control" name="cards" value="">
    </div>
    <button class="btn btn-primary" type="submit">Submit</button>
  </form>

<?php else : ?>

  <?php include 'partials/filled_form.php'; ?>

<?php endif ?>

<?php require "partials/footer.php"; ?>
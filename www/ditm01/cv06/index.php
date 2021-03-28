<?php include './includes/header.php'; ?>
<?php include './includes/nav.php'; ?>

  <div class="container">
    <div class="row">
      <?php require './components/categoryDisplay.php'?>
      <div class="col-lg-9">
        <?php require './components/slideDisplay.php'?>
        <?php require './components/productDisplay.php'?>
      </div>
    </div>
  </div>
<?php include './includes/footer.php'; ?>
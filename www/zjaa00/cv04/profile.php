<?php include "partials/header.php"; ?>

<div class="profile-card">
  <div style="background-image: url('img/homer.png');"></div>
  <div class="info">
    <h1>
      <?= isset($_GET["name"]) ? $_GET["name"] : "" ?>
    </h1>
    <small><?= isset($_GET["email"]) ? $_GET["email"] : "" ?></small>
    <p>
      Cupcake ipsum dolor sit amet tart muffin cake. I love dessert marzipan I love muffin cheesecake dragée. Fruitcake jelly-o biscuit.
    </p>
  </div>
</div>

<?php require "partials/footer.php"; ?>
<?php

  require("./partials/header.php");
  
  if (!empty($_POST)) {
    $stmt = $connect->prepare("
      INSERT INTO goods (name, description, price)
      VALUES (?, ?, ?);
    ");
    $stmt->execute([
      $_POST['name'],
      $_POST['description'],
      (float) $_POST['price']
    ]);

    header("Location: index.php");

  }
  
?>

  <h1>Create good</h1>

  <form action="./create-item.php" class="form-signin" method="POST">
    <div class="form-label-group">
      <label for="name">Good name</label>
      <input name="name" class="form-control" placeholder="Name" required autofocus value="">
    </div>

    <div class="form-label-group">
      <label for="price">Price</label>
      <input name="price" class="form-control" placeholder="Price" required value="">
    </div>

    <div class="form-label-group">
      <label for="description">Description</label>
      <textarea name="description" rows="5" class="form-control" placeholder="Description"></textarea>
    </div>
    <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Add</button> or <a href="index.php">Cancel</a>
  </form>

<?php require("./partials/footer.php"); ?>

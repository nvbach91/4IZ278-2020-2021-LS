<?php
  require("./manager-required.php");
  require("./includes/header.php");

  if (!empty($_POST)) {
    $statement = $connect->prepare("
      INSERT INTO goods (name, description, price, img)
      VALUES (?, ?, ?, ?);
    ");
    $statement->execute([
      $_POST['name'],
      $_POST['description'],
      (float) $_POST['price'],
      $_POST['img'],
    ]);

    header("Location: index.php");

  }

?>

  <h1>Create good</h1>

  <form action="./create-good.php" class="form-signin" method="POST">
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

    <div class="form-label-group">
      <label for="description">Image url</label>
      <input name="img" rows="5" class="form-control" placeholder="Img"></textarea>
    </div>
    <div class="mt-2">
        <button class="btn btn-primary btn-block text-uppercase" type="submit">Add</button> or <a class="btn btn-outline-danger"href="index.php">Cancel</a>
    </div>
  </form>

<?php require("./includes/footer.php"); ?>
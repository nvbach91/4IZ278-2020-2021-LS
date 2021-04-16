<?php

  require("./includes/header.php");

  if (!empty($_POST)) {
    $stmt = $connect->prepare("
      UPDATE goods SET
      name = :name,
      description = :description,
      price = :price,
      img = :img
      WHERE id = :id;
    ");
    $stmt->execute([
      "id" => $_POST['id'],
      "name" => $_POST['name'],
      "description" => $_POST['description'],
      "price" => (float) $_POST['price'],
      "img" => $_POST['img'],
    ]);

    header("Location: edit-good.php?id=".$_POST['id']."&update=success");

  }

  $good = $connect->prepare("SELECT * FROM goods WHERE id = :id;");
  $good->execute(['id' => $_GET['id']]);
  $good = $good->fetchAll()[0];

  if (@$_GET['update'] === "success"):
?>

    <div style="padding: 10px; background: #0fc900; color: white; border-radius: 10px;">Updated successfuly</div>

<?php endif; ?>
  <h1>Update good</h1>

  <form action="./edit-good.php" class="form-signin" method="POST">
    <div class="form-label-group">
      <label for="name">Good name</label>
      <input name="name" class="form-control" placeholder="Name" required autofocus value="<?= $good['name']; ?>">
    </div>

    <div class="form-label-group">
      <label for="price">Price</label>
      <input name="price" class="form-control" placeholder="Price" required value="<?= $good['price']; ?>">
    </div>

    <div class="form-label-group">
      <label for="description">Description</label>
      <textarea name="description" rows="5" class="form-control" placeholder="Description"><?= $good['description']; ?></textarea>
    </div>
    <input type="hidden" name="id" value="<?= $good['id'];?>">

    <div class="form-label-group">
      <label for="img">Image</label>
      <input name="img" class="form-control" placeholder="image" required value="<?= $good['img']; ?>">
    </div>
    
    <div class="mt-2"></div>
    <button class="btn btn-primary btn-block text-uppercase" type="submit">Save</button> or <a class="btn btn-outline-danger" href="index.php">Cancel</a>
  </form>

<?php require("./includes/footer.php"); ?>
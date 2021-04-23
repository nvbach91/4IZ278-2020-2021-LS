<?php

  require("./partials/header.php");
  
  if (@$_SESSION['user_privilege'] < 2) {
    header('Location: logout.php');
    die();
  }

  if (!empty($_POST)) {
    $stmt = $connect->prepare("
      UPDATE goods SET
      name = :name,
      description = :description,
      price = :price
      WHERE id = :id;
    ");
    $stmt->execute([
      "name" => $_POST['name'],
      "description" => $_POST['description'],
      "price" => (float) $_POST['price'],
      "id" => $_POST['id']
    ]);

    header("Location: edit-item.php?id=".$_POST['id']."&update=success");

  }
  
  $good = $connect->prepare("SELECT * FROM goods WHERE id = :id;");
  $good->execute(['id' => $_GET['id']]);
  $good = $good->fetchAll()[0];

  if (@$_GET['update'] === "success"):
?>

    <div style="padding: 10px; background: #0fc900; color: white; border-radius: 10px;">Updated successfuly</div>

<?php endif; ?>
  <h1>Update good</h1>

  <form action="./edit-item.php" class="form-signin" method="POST">
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
    <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Save</button> or <a href="home.php">Cancel</a>
  </form>

<?php require("./partials/footer.php"); ?>

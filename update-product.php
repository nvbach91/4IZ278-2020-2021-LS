<?php
  require("./config/config.php");
  require("./admin-required.php");
  require("./partials/header.php");
  require("navigation.php");

  $invalidInputs = [];
  $alertMessages = [];
  $alertType = 'alert-danger';
  if (!empty($_POST)) {

    $name = htmlspecialchars(trim($_POST['name']));
    $price = htmlspecialchars(trim($_POST['price']));
    $description = htmlspecialchars(trim($_POST['description']));
    $img = htmlspecialchars(trim($_POST['img']));
    $category = htmlspecialchars(trim($_POST['category']));

    if (strlen($name)<3) {
        array_push($alertMessages, 'Please enter longer product name');
        array_push($invalidInputs, 'name');
    }

    if ($price < 0) {
        array_push($alertMessages, 'Please enter some real price');
        array_push($invalidInputs, 'price');
    }

    if (strlen($description) < 10) {
        array_push($alertMessages, 'Please enter longer description more than 10');
        array_push($invalidInputs, 'description');
    }

    if (!filter_var($img, FILTER_VALIDATE_URL)) {
        array_push($alertMessages, 'Please use a valid URL for product img');
        array_push($invalidInputs, 'img');
    }
    
    if (empty($invalidInputs)) {
      $stmt = $connect->prepare("
      UPDATE goods SET
      name = :name,
      description = :description,
      price = :price,
      img = :img,
      category =:category
      WHERE id = :id;
    ");
    $stmt->execute([
      "id" => $_POST['id'],
      "name" => $_POST['name'],
      "description" => $_POST['description'],
      "price" => (float) $_POST['price'],
      "category" => $_POST['category'],
      "img" => $_POST['img'],
    ]);
    header("Location: update-product.php?id=".$_POST['id']."&update=success");
    }
  }

  if (isset($_GET['id'])){
    $good = $connect->prepare("SELECT * FROM goods WHERE id = :id;");
    $good->execute(['id' => $_GET['id']]);
    $good = $good->fetchAll()[0];
  }

  $stmt = $connect->prepare('SELECT * FROM categories');
  $stmt->execute();
  $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
  if (@$_GET['update'] === "success"):
?>


<div style="padding: 10px; background: #0fc900; color: white; border-radius: 10px;">Updated successfuly</div>
<?php endif; ?>

<div class="container">
  <h1>Update Product</h1>
  <?php if (!empty($_POST)): ?>
    <div class="alert <?php echo $alertType; ?>"><?php echo implode('<br>', $alertMessages); ?></div>
  <?php endif; ?>
  <form action="./update-product.php" class="form-signin" method="POST">
    <div class="form-label-group">
      <label for="name">Product name</label>
      <input name="name" class="form-control<?php echo in_array('name', $invalidInputs) ? ' is-invalid' : '' ?>" placeholder="Name" required autofocus value="<?php echo isset($good['name']) ? $good['name'] : $name ?>">
    </div>

    <div class="form-label-group">
      <label for="price">Price</label>
      <input name="price" class="form-control" placeholder="Price" required value="<?php echo isset($good['price']) ? $good['price'] : $price ?>">
    </div>

    <div class="form-group">
    <label for="exampleFormControlSelect1">Category</label>
    <select class="form-control" id="exampleFormControlSelect1" name="category">
    <?php foreach($categories as $category_one): ?>
    <option value="<?php echo $category_one['id'] ?>" <?php if(isset($good['category'])) {echo $good['category'] === $category_one['id'] ? 'selected' : ''; } else { echo $category_one['id'] === $category ? 'selected': ''; }?>><?php echo $category_one['name'] ?></option>
    <?php endforeach ?>
    </select>
  </div>

    <div class="form-label-group">
      <label for="description">Description</label>
      <textarea name="description" rows="5" class="form-control" placeholder="Description"><?php echo isset($good['description']) ? $good['description'] : $description ?></textarea>
    </div>
    <input type="hidden" name="id" value="<?php if(isset($good['id'])) {echo $good['id'];} else {echo $_POST['id'];} ?>">

    <div class="form-label-group">
      <label for="img">Image</label>
      <input name="img" class="form-control" placeholder="image" required value="<?php echo isset($good['img']) ? $good['img'] : $img ?>">
    </div>
    
    <div class="mt-2"></div>
    <button class="btn btn-primary btn-block text-uppercase" type="submit">Save</button>
    <a class="btn btn-outline-danger mt-2" href="index.php">Cancel</a>
  </form>
</div>
<?php require("./partials/footer.php"); ?>
<?php
  require_once __DIR__ . '/config/config.php';
  require __DIR__ . '/admin-required.php';

  include __DIR__ . '/partials/header.php';
  include __DIR__ . '/navigation.php';

  $invalidInputs = [];
  $alertMessages = [];
  $alertType = 'alert-danger';
  $submittedForm = !empty($_POST);
  if ($submittedForm) {

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
        array_push($alertMessages, 'Please enter longer description more than 10 words');
        array_push($invalidInputs, 'description');
    }

    if (!filter_var($img, FILTER_VALIDATE_URL)) {
        array_push($alertMessages, 'Please use a valid URL for product img');
        array_push($invalidInputs, 'img');
    }


    if (empty($invalidInputs)) {

    $statement = $connect->prepare("
       INSERT INTO goods (name, description, price, img, category)
       VALUES (?, ?, ?, ?, ?);
    ");
    $statement->execute([
      $_POST['name'],
      $_POST['description'],
      (float) $_POST['price'],
      $_POST['img'],
      $_POST['category'],
    ]);
    header("Location: index.php");
    }
    }

    $stmt = $connect->prepare('SELECT * FROM categories');
    $stmt->execute();
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="container">
  <h1>Create product</h1>
  <?php if ($submittedForm): ?>
      <div class="alert <?php echo $alertType; ?>"><?php echo implode('<br>', $alertMessages); ?></div>
  <?php endif; ?> 
  <form action="./create-product.php" class="form-signin" method="POST">
    <div class="form-label-group">
      <label for="name">Product name</label>
      <input name="name" class="form-control" placeholder="Name" value="<?php echo isset($name)? $name : ''?>">
    </div>

    <div class="form-label-group">
      <label for="price">Price</label>
      <input name="price" class="form-control" placeholder="Price" value="<?php echo isset($price)? $price : ''?>">
    </div>

    <div class="form-group">
    <label for="exampleFormControlSelect1">Category</label>
    <select class="form-control" id="exampleFormControlSelect1" name="category">
    <?php foreach($categories as $category_one): ?>
      <option value="<?php echo $category_one['id'] ?>" <?php if(isset($category)) {if($category_one['id'] === $category){echo 'selected';}}?>><?php echo $category_one['name'] ?></option>
    <?php endforeach ?>
    </select>
  </div>
    <div class="form-label-group">
      <label for="description">Description</label>
      <textarea name="description" rows="5" class="form-control" placeholder="Description"><?php echo isset($description)? $description : ''?></textarea>
    </div>

    <div class="form-label-group">
      <label for="description">Image url</label>
      <input name="img" rows="5" class="form-control" placeholder="Img" value="<?php echo isset($img)? $img : ''?>">
    </div>
    <div class="mt-2">
        <button class="btn btn-primary btn-block text-uppercase" type="submit">Add</button>
    </div>
  </form>
  <a class="btn btn-outline-danger my-3" href="index.php">Cancel</a>
</div>
<?php require("./partials/footer.php"); ?>
<?php
  session_start();
  require_once __DIR__ . '/config/config.php';
  require __DIR__ . '/admin-required.php';

    include __DIR__ . '/partials/header.php';
    include __DIR__ . '/navigation.php';

  if (!empty($_POST)) {

//     $product_name = $_POST['name'];
//     $description = $_POST['destription'];
//     $price = $_POST['price'];
//     $img = $_POST['img'];


//     $exists = $connect->prepare('SELECT * FROM users WHERE email = :email LIMIT 1');

//     $exists->execute([
//       'email' => $email
//     ]);

//     $existing_user = @$exists->fetchAll()[0];

//     if ($existing_user) {
//         array_push($alertMessages, "Email already used");
//     } 
//     else if (strlen($password) < 4) {
//         array_push($alertMessages, "Choose longer password");
//     }
//     else if ($password !== $con_password){

//         array_push($alertMessages, "Please enter same passwords");
//     } else {
//         $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

//     //vlozime usera do databaze
//     $stmt = $connect->prepare('INSERT INTO users(email, password) VALUES (:email, :password)');
//     $stmt->execute([
//         'email' => $email, 
//         'password' => $hashedPassword
//     ]);


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

<div class="container">
  <h1>Create product</h1>

  <form action="./create-good.php" class="form-signin" method="POST">
    <div class="form-label-group">
      <label for="name">Product name</label>
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
        <button class="btn btn-primary btn-block text-uppercase" type="submit">Add</button>
    </div>
  </form>
  <a class="btn btn-outline-danger my-3" href="index.php">Cancel</a>
</div>

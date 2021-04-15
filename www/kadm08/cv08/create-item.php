<?php

require __DIR__ . '/db.php';


$success = false;

$errors = [];
if (!empty($_POST)) {
    if (!is_numeric($_POST['price'])) array_push($errors, "Price must be a number");
}

if (!empty($_POST) and empty($errors)) {
    $statement = $pdo->prepare("
                         INSERT INTO goods (name, price, description, img) 
                         VALUES (?, ?, ?, ?)                                           
                         ");
    $statement->execute([
        $_POST['name'],
        $_POST['price'],
        $_POST['description'],
        $_POST['img']
      ]);
    $success = true;
}
?>


<?php require __DIR__ . '/includes/header.php'; ?>
<main class="container">
    <h1>Add new item</h1>
    <ul>
        <?php foreach ($errors as $message) : ?>
            <div class="error"><?php echo  $message; ?></div>
        <?php endforeach; ?>
        <?php if ($success) : ?>
            <div class="success">You have successfully added new item</div>
        <?php endif; ?>
    </ul>

    <form method="POST">
        <div class="form-group">
            <label for="name">Name</label>
            <input class="form-control" id="name" name="name" placeholder="Name">
            <label for="name">Price</label>
            <label for="price"></label><input class="form-control" id="price" name="price" placeholder="Price">
            <label for="name">Description</label>
            <label for="description"></label><input class="form-control" id="description" name="description" placeholder="Description">
            <label for="name">Image URL</label>
            <label for="img"></label><input class="form-control" id="img" name="img" placeholder="Img url" />
        </div>
        <button type="submit" class="btn btn-primary">Add</button>
    </form>
    <div style="margin-bottom: 600px"></div>
</main>
<?php require __DIR__ . '/includes/footer.php'; ?>
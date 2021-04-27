<?php require __DIR__.'/db.php'; ?>
<?php
$success = false;
$errors = [];
session_start();
if (!empty($_POST)) {
    if (!is_numeric($_POST['price'])) array_push($errors, "Price must be a number");
}
if (!empty($_POST)) {
    $statement = $db->prepare("
      UPDATE goods SET
      name = :name,
      description = :description,
      price = :price,
      img = :img
      WHERE id = :id;
    ");
    $statement->execute([
      "id" => $_GET['id'],
      "name" => $_POST['name'],
      "description" => $_POST['description'],
      "price" =>  $_POST['price'],
      "img" => $_POST['img'],
    ]);

    $success = true;
}
$item = $db->prepare("SELECT * FROM goods WHERE id = :id;");
$item->execute(['id' => $_GET['id']]);
$item = $item->fetchAll()[0];
?>

<?php require __DIR__ . '/incl/header.php'; ?>
<main class="container">
    <h1>Edit an item</h1>
    <ul>
        <?php foreach ($errors as $message) : ?>
            <div class="error"><?php echo  $message; ?></div>
        <?php endforeach; ?>
        <?php if ($success) : ?>
            <div class="success">You have successfully edited an item</div>
        <?php endif; ?>
    </ul>

    <form method="POST">
        <div class="form-group">
            <label for="name">Name</label>
            <input class="form-control" id="name" name="name" value="<?= $item['name'] ?>" />
            <label for="name">Price</label>
            <label for="price"></label><input class="form-control" id="price" name="price" value="<?= $item['price'] ?>" />
            <label for="name">Description</label>
            <label for="description"></label><input class="form-control" id="description" name="description" value="<?= $item['description'] ?>" />
            <label for="name">Image URL</label>
            <label for="img"></label><input class="form-control" id="img" name="img" value="<?= $item['img'] ?>" />
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</main>
<?php require __DIR__ . '/incl/footer.php'; ?>

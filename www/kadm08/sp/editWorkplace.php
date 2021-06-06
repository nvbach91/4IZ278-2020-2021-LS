<?php
session_start();

require __DIR__ . '/db.php';
require __DIR__ . '/user_required.php';

$success = false;

$errors = [];

if (!empty($_POST)) {
    if (!is_numeric($_POST['price'])) array_push($errors, "Price must be a number");
}

if (!empty($_POST) and empty($errors)) {
    $statement = $pdo->prepare("UPDATE workplace SET 
                            name = :name,
                            price_per_day = :price
                            WHERE ws_id = :ws_id;");
    $statement->execute([
        'ws_id' => $_GET['ws_id'],
        'name' => $_POST['name'],
        'price' => $_POST['price']
    ]);

    $success = true;
}

$item = $pdo->prepare("SELECT * FROM workplace WHERE ws_id = :ws_id;");
$item->execute(['ws_id' => $_GET['ws_id']]);
$item = $item->fetchAll()[0];


?>


<?php require __DIR__ . '/includes/header.php'; ?>
<main class="container">
<br /><br />
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
            <label for="id">ID</label>
            <input readonly class="form-control" id="id" name="id" value="<?= $item['ws_id'] ?>" />
            <label for="name">Name</label>
            <input class="form-control" id="name" name="name" value="<?= $item['name'] ?>" />
            <label for="price">Price</label>
            <label for="price"></label><input class="form-control" id="price" name="price" value="<?= $item['price_per_day'] ?>" />
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
    <div style="margin-bottom: 600px"></div>
</main>
<?php require __DIR__ . '/includes/footer.php'; ?>
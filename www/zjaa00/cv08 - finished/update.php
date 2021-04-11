<?php
// pripojeni do db
require './_inc/config.php';

require 'user_required.php';

// pristup jen pro admina
require 'admin_required.php';

$stmt = $connect->prepare('SELECT * FROM goods WHERE id = :id');
$stmt->execute([
    'id' => $_GET['id']
]);
$good = $stmt->fetch();

if (!$good) {
    exit('Unable to find good!');
}

if ('POST' == $_SERVER['REQUEST_METHOD']) {
    $stmt = $connect->prepare('UPDATE goods SET name = :name, description = :description, price = :price WHERE id = :id');
    $stmt->execute([
        'name' => $_POST['name'], 
        'description' => $_POST['description'], 
        'price' => (float) $_POST['price'], 
        'id' => (int) $_POST['id']
    ]);

    header('Location: index.php');
}

?>

<?php require __DIR__ . '/partials/header.php' ?>
<main class="container">
    
    <h1>Update good</h1>

    <form class="form-signin" method="POST">
        <div class="form-label-group">
            <label for="name">Good name</label>
            <input name="name" class="form-control" placeholder="Name" required autofocus value="<?php echo $good['name']; ?>">
        </div>

        <div class="form-label-group">
            <label for="price">Price</label>
            <input name="price" class="form-control" placeholder="Price" required value="<?php echo $good['price']; ?>">
        </div>

        <div class="form-label-group">
            <label for="description">Description</label>
            <input name="description" class="form-control" placeholder="Description" required value="<?php echo $good['description']; ?>">
        </div>
        <input type="hidden" name="id" value="<?php echo $good['id'];?>'">
        <br>
        <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Save</button> or <a href="index.php">Cancel</a>
    </form>
<div style="margin-bottom: 600px"></div>
<?php require __DIR__ . '/partials/footer.php' ?>

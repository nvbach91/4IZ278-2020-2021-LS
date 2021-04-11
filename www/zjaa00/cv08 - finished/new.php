<?php
// pripojeni do db
require './_inc/config.php';

// pristup jen pro prihlaseneho uzivatele
require 'user_required.php';

// pristup jen pro admina
require 'admin_required.php';

if ('POST' == $_SERVER['REQUEST_METHOD']) {
    $stmt = $connect->prepare('INSERT INTO goods(name, description, price) VALUES (?, ?, ?)');
    $stmt->execute([$_POST['name'], $_POST['description'], (float) $_POST['price']]);

    header('Location: index.php');
}

?>

<?php require __DIR__ . '/partials/header.php' ?>
<main class="container">
    <h1>Create new good</h1>
    
    <form class="form-signin" method="POST">
        <div class="form-label-group">
            <label for="name">Good name</label>
            <input name="name" class="form-control" placeholder="Name" required autofocus>
        </div>

        <div class="form-label-group">
            <label for="price">Price</label>
            <input type="number" name="price" class="form-control" placeholder="Price" required>
        </div>

        <div class="form-label-group">
            <label for="description">Description</label>
            <input name="description" class="form-control" placeholder="Description" required>
        </div>
        <br>
        <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Save</button> or <a href="index.php">Cancel</a>
    </form>
</main>
<div style="margin-bottom: 600px"></div>
<?php require __DIR__ . '/partials/footer.php' ?>

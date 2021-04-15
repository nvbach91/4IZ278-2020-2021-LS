<?php
require 'db.php';

$stmt = $db->prepare("SELECT * FROM goods WHERE id=?");
$stmt->execute(array($_GET['id']));
$client = $stmt->fetch();

if (!$client){
    die("Unable to find a client");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_GET['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $img = $_POST['img'];


    $stmt = $db->prepare("UPDATE goods SET name=?,price=?, description=?, img=? WHERE id=?");
    $stmt->execute(array($name, $price, $description, $img, $id));

    header('Location: index.php');

}
?>
<?php require './incl/header.php'; ?>
<?php include './incl/navbar.php'; ?>
    <main class="container">
        <h1>Update item</h1>
        <form method="POST">
            <div class="form-group">
                <label for="name">Name</label>
                <input class="form-control" id="name" name="name" value="<?= $client['name']?>"/>
                <label for="price">Price</label>
                <input class="form-control" id="price" name="price" value="<?= $client['price']?>"/>
                <label for="name">Description</label>
                <label for="description"></label><input class="form-control" id="description" name="description" value="<?= $client['description']?>"/>
                <label for="name">Img url</label>
                <label for="img"></label><input class="form-control" id="img" name="img" value="<?= $client['img']?>"/>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <div style="margin-bottom: 600px"></div>
    </main>
<?php require './incl/footer.php'; ?> 
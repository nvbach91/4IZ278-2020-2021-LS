<?php require_once __DIR__ . '/../db/ProductsDB.php'; ?>

<?php
$productsDB = new ProductsDB();
$invalidInputs = [];

if (!empty($_POST)) {
    $name = htmlspecialchars(trim($_POST['name']));
    $price = htmlspecialchars(trim($_POST['price']));
    $img = trim($_POST['img']);

    if (!$name) {
        array_push($invalidInputs, 'Name is empty');
    }
    if (!$price) {
        array_push($invalidInputs, 'Price is empty');
    }
    if (!preg_match('/^[0-9]*$/', $price)) {
        array_push($invalidInputs, 'Price has to be an integer');
    }
    if (!$img) {
        array_push($invalidInputs, 'Image is empty');
    }

    $isValidForm = count($invalidInputs) == 0;

    if ($isValidForm) {
        $productsDB->add($name, $price, $img);
    }
}



?>

<?php require __DIR__ . '/../incl/header.php'; ?>
<h1>Add a new item</h1>
<?php foreach ($invalidInputs as $invalidInput) : ?>
    <p><?php echo $invalidInput; ?>
    <?php endforeach ?>
    <form method="POST">
        <div>
            <label>name:</label>
            <input name="name">
        </div>
        <div>
            <label>price:</label>
            <input name="price">
        </div>
        <div>
            <label>image:</label>
            <input name="img">
        </div>

        <div><input type="submit" value="Add"></div>
    </form>
    <?php require __DIR__ . '/../incl/footer.php'; ?>
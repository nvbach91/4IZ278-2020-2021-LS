<?php require_once __DIR__ . '/../db/ProductsDB.php'; ?>

<?php
session_start();
if (!$_SESSION['admin'] || $_SESSION['admin'] == 1) {
    header('Location: /./~vonm10/beardwithme/index.php');
}

$productsDB = new ProductsDB();
$invalidInputs = [];

if (!empty($_POST)) {
    $name = htmlspecialchars(trim($_POST['name']));
    $price = (int)htmlspecialchars(trim($_POST['price']));
    $img = trim($_POST['img']);
    $description = htmlspecialchars(trim($_POST['description']));
    $category = htmlspecialchars(trim($_POST['category']));

    if (!$name) {
        array_push($invalidInputs, 'Name is empty');
    }
    if (!$price) {
        array_push($invalidInputs, 'Price is empty');
    }
    if (!$img) {
        array_push($invalidInputs, 'Image is empty');
    }
    if (!$description) {
        array_push($invalidInputs, 'Description is empty');
    }
    if (!$category) {
        array_push($invalidInputs, 'Category is empty');
    }

    $isValidForm = count($invalidInputs) == 0;

    if ($isValidForm) {
        $productsDB->add($name, $price, $img, $description, $category);
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
        <div>
            <label>description:</label>
            <input name="description">
        </div>
        <div>
            <label>category ID:</label>
            <input name="category">
        </div>
        <div><input type="submit" value="Add"></div>
    </form>
    <?php require __DIR__ . '/../incl/footer.php'; ?>
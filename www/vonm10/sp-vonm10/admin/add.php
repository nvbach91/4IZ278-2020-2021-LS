<?php require_once __DIR__ . '/../db/ProductsDB.php'; ?>

<?php
session_start();
if (!$_SESSION['admin'] || $_SESSION['admin'] == 1) {
    header('Location: /./~vonm10/beardwithme/index.php');
    die('Invalid permission');
}

$productsDB = new ProductsDB();
$invalidInputs = [];

if (!empty($_POST)) {
    $name = htmlspecialchars(trim($_POST['name']));
    $price = (int)htmlspecialchars(trim($_POST['price']));
    $img = trim($_POST['img']);
    $description = htmlspecialchars(trim($_POST['description']));
    $category = htmlspecialchars(trim($_POST['category']));

    // pridat ochranu vstupu
    if (!$name) {
        array_push($invalidInputs, 'Name is empty');
    }
    if (!is_string($name)) {
        array_push($invalidInputs, 'Name has to be a string');
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
    if (!preg_match('/(https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|www\.[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9]+\.[^\s]{2,}|www\.[a-zA-Z0-9]+\.[^\s]{2,})/', $img)) {
        array_push($invalidInputs, 'Image has to be an URL');
    }
    if (!$description) {
        array_push($invalidInputs, 'Description is empty');
    }
    if (!is_string($description)) {
        array_push($invalidInputs, 'Description has to be a string');
    }
    if (!$category) {
        array_push($invalidInputs, 'Category is empty');
    }
    if (!preg_match('/^[0-9]*$/', $category)) {
        array_push($invalidInputs, 'Category has to be an integer');
    }

    $isValidForm = count($invalidInputs) == 0;

    if ($isValidForm) {
        $success = $productsDB->add($name, $price, $img, $description, $category);
        if($success)
        {
            echo "Success";
        } else {echo "There was an error";}
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
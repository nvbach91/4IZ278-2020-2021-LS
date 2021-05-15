<?php require_once __DIR__ . '/../db/ProductsDB.php'; ?>

<?php
session_start();
if ($_SESSION['admin'] == 1) {
    header('Location: /./~vonm10/cv06/index.php');
}

$productsDB = new ProductsDB();
$invalidInputs = [];


if (!empty($_GET['id'])) {
    $id = $_GET['id'];

    $product = $productsDB->fetch($id);
    $getName = $product['name'];
    $getPrice = $product['price'];
    $getImg = $product['img'];

    $now = date_create('now')->format('Y-m-d H:i:s');

    // Zde kontrola jestli nekdo edituje. Sloupce edited_by a opened_at
    // Jsem to ja? Je editace aktivni? = time() - time(opened_at) < urcena doba
    // Po skonceni editace smazu sloupce 

    if ($product['edited_by']) {
        if ($product['edited_by'] != $_SESSION['user_id']) {
            if (time() - strtotime($product['opened_at']) < 30 * 60) {
                exit("Some else is still editing this record");
            }
        }
    }

    $productsDB->pessimisticUpdate($_SESSION['user_id'], $now, $id);


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
        if (!preg_match('/^-?(?:\d+|\d*\.\d+)$/', $price)) {
            array_push($invalidInputs, 'Price has to be an integer');
        }
        if (!$img) {
            array_push($invalidInputs, 'Image is empty');
        }

        $isValidForm = count($invalidInputs) == 0;

        if ($isValidForm) {
            $productsDB->update($id, $name, $price, $img);

            $sql = "UPDATE products SET edited_by = :user_id, opened_at = :opened_at WHERE id = :product_id;";
            $stmt = $productsDB->pessimisticUpdate(null, null, $id);
        }
    }
}

?>




<?php require __DIR__ . '/../incl/header.php'; ?>
<h1>Update an item</h1>
<?php foreach ($invalidInputs as $invalidInput) : ?>
    <p><?php echo $invalidInput; ?>
    <?php endforeach ?>
    <form id="updateItem" method="POST">
        <div>
            <label>name:</label>
            <input name="name" value=<?php echo $getName ?>>
        </div>
        <div>
            <label>price:</label>
            <input name="price" value=<?php echo $getPrice ?>>
        </div>
        <div>
            <label>image:</label>
            <input name="img" value=<?php echo $getImg ?>>
        </div>
        <div><input type="submit" value="Update"></div>
    </form>
    <?php require __DIR__ . '/../incl/footer.php'; ?>
<?php require_once __DIR__ . '/../db/ProductsDB.php'; ?>

<?php
$productsDB = new ProductsDB();
$invalidInputsGet = [];

if (!empty($_GET['id'])) {
    $id = htmlspecialchars(trim($_GET['id']));

    if (!$id) {
        array_push($invalidInputsGet, 'ID is empty');
    }
    if (!preg_match('/^[0-9]*$/', $id)) {
        array_push($invalidInputsGet, 'ID has to be an integer');
    }

    $isValidFormGet = count($invalidInputsGet) == 0;

    if ($isValidFormGet) {
        $product = $productsDB->fetch($id);
    }
}


//   $name = htmlspecialchars(trim($_POST['name']));
//  $price = htmlspecialchars(trim($_POST['price']));
//  $img = trim($_POST['img']);

?>


<?php require __DIR__ . '/../incl/header.php'; ?>
<h1>Update an item</h1>
<?php foreach ($invalidInputsGet as $invalidInput) : ?>
    <p><?php echo $invalidInput; ?>
    <?php endforeach ?>
    <form id="getItem" method="GET" action="update.php">
        <div>
            <label>ID:</label>
            <input name="id">
            <input type="submit" value="Fetch">
        </div>
    </form>

    <?php require __DIR__ . '/../incl/footer.php'; ?>
<?php require_once __DIR__ . '/../db/ProductsDB.php'; ?>

<?php
session_start();
if (!$_SESSION['admin'] || $_SESSION['admin'] == 1) {
    header('Location: /./~vonm10/beardwithme/index.php');
}

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
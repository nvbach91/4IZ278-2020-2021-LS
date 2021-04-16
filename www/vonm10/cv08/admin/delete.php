<?php require_once __DIR__ . '/../db/ProductsDB.php'; ?>
<?php
$productsDB = new ProductsDB();
$invalidInputs = [];

if (!empty($_POST)) {
    $id = htmlspecialchars(trim($_POST['id']));

    if (!$id) {
        array_push($invalidInputs, 'ID is empty');
    }
    if (!preg_match('/^[0-9]*$/', $id)) {
        array_push($invalidInputs, 'ID has to be an integer');
    }

    $isValidForm = count($invalidInputs) == 0;

    if ($isValidForm) {
        $productsDB->delete($id);
    }
}



?>

<?php require __DIR__ . '/../incl/header.php'; ?>
<h1>Delete an item</h1>
<?php foreach ($invalidInputs as $invalidInput) : ?>
    <p><?php echo $invalidInput; ?>
    <?php endforeach ?>
    <form method="POST">
        <div>
            <label>ID:</label>
            <input name="id">
            <input type="submit" value="Delete">
        </div>
    </form>
    <?php require __DIR__ . '/../incl/footer.php'; ?>
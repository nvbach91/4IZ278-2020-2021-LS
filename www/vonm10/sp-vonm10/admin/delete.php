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
    $id = htmlspecialchars(trim($_POST['id']));

    if (!$id) {
        array_push($invalidInputs, 'ID is empty');
    }
    if (!preg_match('/^[0-9]*$/', $id)) {
        array_push($invalidInputs, 'ID has to be an integer');
    }

    $isValidForm = count($invalidInputs) == 0;

    if ($isValidForm) {
        // nejprve select
        if($productsDB->fetch($id))
        {
            $productsDB->delete($id);
        } else {die('Product does not exist');}
        
    }
}


// vypsat tabulku vsech produktu
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
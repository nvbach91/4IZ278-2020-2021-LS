<?php require_once __DIR__ . '/../db/ProductsDB.php'; ?>
<?php
session_start();
if (!$_SESSION['admin'] || $_SESSION['admin'] == 1) {
    header('Location: /./~vonm10/beardwithme/index.php');
    die('Invalid permission');
}

$productsDB = new ProductsDB();
$products = $productsDB->fetchAll();

if (!empty($_POST)) {
    $id = $_POST['button'];

    if ($productsDB->fetch($id)) {
        $productsDB->delete($id);
        header("Refresh:0");
    } else {
        die('Product does not exist');
    }
}


// vypsat tabulku vsech produktu
?>



<?php require __DIR__ . '/../incl/header.php'; ?>
<h1>Delete</h1>
<table border="1">
    <tr>
        <th>id</th>
        <th>name</th>
        <th>price</th>
        <th>delete</th>
    </tr>
    <?php foreach ($products as $product) : ?>
        <form method="POST">
            <tr>
                <td><?php echo $product['id'] ?></td>
                <td><?php echo $product['name'] ?></td>
                <td><?php echo $product['price'] ?></td>
                <td><button name="button" value=<?php echo $product['id'] ?>>Delete</button></td>
            </tr>
        </form>
    <?php endforeach ?>
</table>
<?php require __DIR__ . '/../incl/footer.php'; ?>
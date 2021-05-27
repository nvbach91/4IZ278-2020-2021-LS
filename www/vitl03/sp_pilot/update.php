<?php require_once __DIR__ . '/class/ProductsDB.php'; ?>
<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['user_privilege'] != 3) {
    header('Location: index.php');
    die();
}


$msg = '';
$msgClass = '';


$productsDB = new ProductsDB();

$product = $productsDB->fetchById(htmlspecialchars($_GET['id']));

if (!$product) {
    exit('Unable to find product!');
}
$_SESSION[$product['product_id'] . '_last_updated_at'] = $product['last_updated_at'];

if ('POST' == $_SERVER['REQUEST_METHOD']) {
    $column = "last_updated_at";
    $last_updated_at = $productsDB->fetchColumn($column, htmlspecialchars($_GET['id']));

    if ($_SESSION[$_GET['id'] . '_last_updated_at'] != $last_updated_at) {
        die("The product was updated by someone else in the meantime!");
    }

    $product = $productsDB->update();

    $msg = 'Item was updated';
    $msgClass = 'alert-success';
    header('Location: index.php');
}

?>

<?php require __DIR__ . '/includes/header.php' ?>
<main class="container">
    <br>
    <h1>Update product</h1>
    <?php if ($msg != '') : ?>
        <div class="alert <?php echo $msgClass; ?>"><?php echo $msg; ?></div>
    <?php endif; ?>
    <form class="form-signin" method="POST">
        <div class="form-label-group">
            <label for="name">Product name</label>
            <input name="name" class="form-control" placeholder="Name" required autofocus value="<?php echo $product['name']; ?>">
        </div>

        <div class="form-label-group">
            <label for="price">Price</label>
            <input name="price" class="form-control" placeholder="Price" required value="<?php echo $product['price']; ?>">
        </div>

        <div class="form-label-group">
            <label for="description">Description</label>
            <input name="desc" class="form-control" placeholder="Description" required value="<?php echo $product['desc']; ?>">
        </div>
        <div class="form-label-group">
            <label for="description">Discount</label>
            <input name="discount" class="form-control" placeholder="Discount" required value="<?php echo $product['discount']; ?>">
        </div>
        <input type="hidden" name="last_updated_at" value="<?php echo $product['last_updated_at']; ?>">
        <input type="hidden" name="last" value="<?php echo $_SESSION[$product['product_id'] . '_last_updated_at']; ?>">
        <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">

        <br>
        <input class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" value="Save"></input> or <a href="index.php">Cancel</a>
    </form>
    <div style="margin-bottom: 600px"></div>
    <?php require __DIR__ . '/includes/footer.php' ?>
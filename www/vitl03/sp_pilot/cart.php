<?php require_once __DIR__ . '/class/ProductsDB.php'; ?>
<?php
$productsDB = new ProductsDB();

if (isset($_POST['product_id']) && is_numeric($_POST['product_id'])) {
    $product_id = (int)  htmlspecialchars($_POST['product_id']);
    $quantity = (int) htmlspecialchars($_POST['quantity']);

    $product = $productsDB->fetchById(htmlspecialchars($_POST['product_id']));
    if ($product && $quantity > 0) {
        if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
            if (array_key_exists($product_id, $_SESSION['cart'])) {
                $_SESSION['cart'][$product_id] += $quantity;
            } else {
                $_SESSION['cart'][$product_id] = $quantity;
            }
        } else {
            $_SESSION['cart'] = array($product_id => $quantity);
        }
    }
    header('location: index.php?page=cart');
    exit;
}
if (isset($_GET['remove']) && is_numeric($_GET['remove']) && isset($_SESSION['cart']) && isset($_SESSION['cart'][$_GET['remove']])) {
    unset($_SESSION['cart'][$_GET['remove']]);
}

if (isset($_POST['update']) && isset($_SESSION['cart'])) {
    foreach (($_POST) as $k => $v) {
        if (strpos($k, 'quantity') !== false && is_numeric($v)) {
            $id = str_replace('quantity-', '', $k);
            $quantity = (int) $v;

            if (is_numeric($id) && isset($_SESSION['cart'][$id]) && $quantity > 0) {
                $_SESSION['cart'][$id] = $quantity;
            }
        }
    }
    header('location: index.php?page=cart');
    exit;
}

if (isset($_POST['placeorder']) && isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    header('Location: index.php?page=checkout');
    exit;
}

$products_in_cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
$products = array();
$subtotal = 0.00;

if ($products_in_cart) {

    $array_to_question_marks = implode(',', array_fill(0, count($products_in_cart), '?'));
    $products = $productsDB->fetchByArray($array_to_question_marks);

    foreach ($products as $product) {
        $subtotal += (float) $product['price'] * (int) $products_in_cart[$product['product_id']];
    }
}
$num_items_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
?>

<?php include __DIR__ . '/includes/header.php' ?>
<?php include __DIR__ . '/includes/navigationCategories.php' ?>
<div class="container">


    <div class="table-responsive cart content-wrapper">
        <br>
        <h1>Shopping Cart</h1>
        <br>
        <form action="index.php?page=cart" method="post">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <td class="table-row" colspan="2">Product</td>
                        <td class="table-row">Price</td>
                        <td class="table-row">Quantity</td>
                        <td class="table-row">Total</td>
                        <td class="table-row">Remove</td>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($products)) : ?>
                        <tr>
                            <td colspan="6" style="text-align:center;">You have no products added in your Shopping Cart</td>
                        </tr>
                    <?php else : ?>
                        <?php foreach ($products as $product) : ?>
                            <tr>
                                <td class="img" style="text-align:center;">
                                    <a href="index.php?page=product&id=<?= $product['product_id'] ?>">
                                        <img src="img/<?php echo $product['name']; ?>.png" width="50" height="50" alt="img/<?php echo $product['name']; ?>.png">
                                    </a>
                                </td>
                                <td style="text-align:center;">
                                    <a href="index.php?page=product&id=<?= $product['product_id'] ?>"><?= $product['name'] ?></a>

                                </td>
                                <td style="text-align:center;" class="price"><?= $product['price'] ?> CZK</td>
                                <td style="text-align:center;" class="quantity">
                                    <input type="number" name="quantity-<?= $product['product_id'] ?>" value="<?= $products_in_cart[$product['product_id']] ?>" min="1" max="<?= $product['quantity'] ?>" placeholder="Quantity" required>
                                </td>
                                <td style="text-align:center;" class="price"><?= $product['price'] * $products_in_cart[$product['product_id']] ?> CZK</td>
                                <td style="text-align:center;"><a href="index.php?page=cart&remove=<?= $product['product_id'] ?>" class="remove"><i style="font-size: 25px;" class="fa fa-trash"></a></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
            <div class="subtotal">
                <span class="text">Subtotal</span>
                <span class="price"><?= $subtotal ?> CZK</span>
            </div>
            <div class="buttons">
                <input type="submit" value="Update" name="update">
                <input type="submit" value="Place Order" name="placeorder">
            </div>
        </form>
    </div>
</div>

<?php include __DIR__ . '/includes/newsletter.php' ?>
<?php include __DIR__ . '/includes/footer.php' ?>
<?php require_once __DIR__ . '/../db/ProductsDB.php'; ?>
<?php

session_start();

$date = time();
$invalidInputs = [];

$productsDB = new ProductsDB();
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
if ($_SESSION) {
    if ($_SESSION['cart']) {
        if (count($_SESSION['cart']) >= 1) {
            $products = $productsDB->fetchByIds($_SESSION['cart']);
        } else {
            header('Location: /./~vonm10/beardwithme/products/cart.php');
        }
    }
    if (!isset($_SESSION['login']) || $_SESSION['login'] == false) {
        header('Location: /./~vonm10/beardwithme/products/cart.php');
    }
}

if (!empty($_POST)) {
    $payment = $_POST['payment'];
    $delivery = $_POST['delivery'];

    if (!$payment) {
        array_push($invalidInputs, 'Payment method is empty');
    }

    if (!$delivery) {
        array_push($invalidInputs, 'Delivery method is empty');
    }

    if (empty($invalidInputs))
    {
        $_SESSION['delivery'] = $delivery;
        $_SESSION['payment'] = $payment;
        header('Location: /./~vonm10/beardwithme/products/checkout.php');
    }

}


$totalPrice = 0;
?>

<?php require __DIR__ . '/../incl/header.php'; ?>
<h4 class="card-title">Select payment and delivery method</h4>
<hr>
<div><?php echo date("Y-m-d H:i:s", $date); ?></div>
<ul>
    <?php foreach ($products as $product) : ?>
        <li>
            <div><a href="<?php echo URL . '/products/product.php?id=' . $product['id'] ?>"><?php echo $product['name'] . '(id=' . $product['id'] . ')'; ?></a></div>
            <div>Price: <?php echo $product['price'] ?></div>
        </li>
        <hr>
        <?php $totalPrice = $totalPrice + $product['price'] ?>
    <?php endforeach ?>
</ul>
<div>Price total: <?php echo $totalPrice ?></div>
<?php $_SESSION['totalPrice'] = $totalPrice; ?>


<?php foreach ($invalidInputs as $message) : ?>
    <p><?php echo $message; ?></p>
<?php endforeach; ?>
<form method="POST">
    <div>
        <label style = "font-weight: bold;">Select payment method:</label>
    </div>
    <div>
        <select name="payment">
            <option value="card">Card</option>
            <option value="bank_transfer ">Bank transfer</option>
            <option value="cash">Cash on delivery</option>
        </select>
    </div>
    <br>
    <div>
        <label style = "font-weight: bold;">Select delivery method:</label>
    </div>
    <div>
        <select name="delivery">
            <option value="PPL">PPL</option>
            <option value="post ">Post service</option>
            <option value="pickup">Pickup in store</option>
        </select>
    </div>
    <div>
        <button>Confirm order</button> 
    </div>
    
</form>

<?php require __DIR__ . '/../incl/footer.php'; ?>
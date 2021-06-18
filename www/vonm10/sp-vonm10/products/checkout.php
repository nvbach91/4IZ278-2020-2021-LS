<?php require_once __DIR__ . '/../db/ProductsDB.php'; ?>
<?php require_once __DIR__ . '/../db/UsersDB.php'; ?>
<?php require_once __DIR__ . '/../db/OrdersDB.php'; ?>
<?php

session_start();

$productsDB = new ProductsDB();
$usersDB = new UsersDB();
$ordersDB = new OrdersDB();

$now = date_create('now')->format('Y-m-d H:i:s');

if (count($_SESSION['cart']) >= 1) {
    $products = $productsDB->fetchByIds($_SESSION['cart']);
} else {
    header('Location: /./~vonm10/beardwithme/products/cart.php');
}

$text = "";
foreach ($products as $product) {
    $text .= '
        <tr>
        <td>' . $product['id'] . '</td>
        <td>' . $product['name'] . '</td>
        <td>' . $product['price'] . '</td>
        </tr>
        ';
}

$to = $usersDB->fetch($_SESSION['user_id'])['email'];
$subject = "Order Confirmation";

$message = "
<html>
<head>
<title>Order Confirmation</title>
</head>
<body>
<p>
Your order at Beard With Me has been confirmed and we are currently processing it.
</p>
<p>
Below you can find a recapitulation of your order:
</p>
<br>
<table>
<tr>
<th>Product ID</th>
<th>Product name</th>
<th>Price</th>
<tr>
" .
    $text
    . "
<table>
<br>
<p>
Total price:
" .
    $_SESSION['totalPrice']
    . "
</p>
<p>
Payment method:
" .
    $_SESSION['payment']
    . "
</p>
<p>
Delivery method:
" .
    $_SESSION['delivery']
    . "
</p>
<br>
<p>
See all your orders <a href='https://eso.vse.cz/~vonm10/beardwithme/myorders.php'>here</a>
</p>
</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <shop@beardwithme.com>' . "\r\n";

$mail = mail($to, $subject, $message, $headers);

if ($mail) {
    foreach ($products as $product) {
        $ordersDB->createOrder($_SESSION['user_id'], $product['id'],$now, $_SESSION['delivery'], $_SESSION['payment']);
    }

    unset($_SESSION['cart']);
    unset($_SESSION['totalPrice']);
    unset($_SESSION['delivery']);
    unset($_SESSION['payment']);
} else {
    die('Checkout failed');
}
?>

<?php require __DIR__ . '/../incl/header.php'; ?>
<h4 class="card-title">Succesful order</h4>
<hr>
<div>You can find order confirmation in your email inbox.</div>
<div>
    <a href="/./~vonm10/beardwithme/index.php">Back to shop</a>
</div>
<?php require __DIR__ . '/../incl/footer.php'; ?>
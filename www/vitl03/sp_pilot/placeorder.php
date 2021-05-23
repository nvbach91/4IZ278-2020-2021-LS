<?php require_once __DIR__ . '/class/PaymentDB.php'; ?>
<?php require_once __DIR__ . '/class/ShippingDB.php'; ?>
<?php require_once __DIR__ . '/class/ProductsDB.php'; ?>
<?php require_once __DIR__ . '/class/UsersDB.php'; ?>
<?php require_once __DIR__ . '/class/OrdersDB.php'; ?>
<?php require_once __DIR__ . '/class/OrderProductDB.php'; ?>
<?php

$productsDB = new ProductsDB();

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

if (isset($_SESSION['payment'])) {
    $paymentDB = new PaymentDB();
    $payment = $paymentDB->fetchById(($_SESSION['payment']));
}
if (isset($_SESSION['shipping'])) {
    $shippingDB = new ShippingDB();
    $shipping = $shippingDB->fetchById(($_SESSION['shipping']));
}
if (isset($_SESSION['email'])) {
    $usersDB = new UsersDB();


    if (isset($_SESSION['password'])) {
        $email = htmlspecialchars($_SESSION['email']);
        $password = htmlspecialchars(trim(($_SESSION['password'])));

        $isExistingUser = false;

        $userRecords =  $usersDB->fetchAll();

        foreach ($userRecords as $userRecord) {
            if (!$userRecord) {
                continue;
            }
            if ($userRecord['email'] == $email) {
                $isExistingUser = true;
                break;
            }
        }
        if (!$isExistingUser) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $usersDB->insert($email, $hashedPassword);
        }
    }
    $user = $usersDB->fetchByEmail($_SESSION['email']);

    if ($user) {
        $userEmail = $user['email'];
    } else {
        $userEmail = $_SESSION['email'];
    }
    if (!($userEmail)) {
        if (isset($_SESSION['userData']['email'])) {
            $userEmail =  $_SESSION['userData']['email'];
        } elseif (isset($_SESSION['access_token'])) {
            $userEmail =  $_SESSION['user_email'];
        }
    }
}

if (isset($_SESSION['detail'])) {
    $detail = ($_SESSION['detail']);
} else {
    $detail = '';
}

$ordersDB = new OrdersDB();


if (!empty($products)) {
    $total = $subtotal + $shipping['price'] + $payment['price'];
    if (isset($_SESSION['firstName'])  && isset($_SESSION['lastName']) && isset($_SESSION['address']) && isset($_SESSION['city']) && isset($_SESSION['country']) && isset($_SESSION['zip']) && isset($_SESSION['phone'])) {
        $firstName = $_SESSION['firstName'];
        $lastName = $_SESSION['lastName'];
        $address = $_SESSION['address'];
        $city = $_SESSION['city'];
        $country = $_SESSION['country'];
        $zipcode = $_SESSION['zip'];
        $tel = ($_SESSION['phone']);


        $ordersDB->insert($userEmail, $total, $user['id'], $payment['payment_id'], $shipping['shipping_id'], $detail, $firstName, $lastName, $address, $city, $country, $zipcode, $tel);

        $orderId = $ordersDB->fetchByEmail($userEmail);

        $to = $userEmail;

        $subject = 'Your order #' . $orderId['order_id'];
        $message = '
    <html>
    <head>
      <title>Thank you for your order. Your order was successfully accepted and we are working on it.</title>
    </head>
    <body>
      <p>Here are the order details!</p>
      <a href="https://eso.vse.cz/~vitl03/sp_pilot/index.php?page=order&id=' . $orderId['order_id'] . '">Click here to show the order details!</a>
      <p>Have a nice day,</p>
      <p>Your Active Team</p>
    </body>
    </html>
    ';

        // To send HTML mail, the Content-type header must be set
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";

        // Additional headers
        $headers .= 'To: ' . $userEmail . '' . "\r\n";
        $headers .= 'From: Active Team <admin@active.com>' . "\r\n";

        // Mail it
        mail($to, $subject, $message, $headers);
    }
}

$order = $ordersDB->fetchByEmail($userEmail);

if (!empty($products)) {
    foreach ($products as $product) {
        $orderProductDB = new OrderProductDB();
        $orderProductDB->insert($order['order_id'], $product['product_id'], $products_in_cart[$product['product_id']]);
    }
}

?>

<?php include __DIR__ . '/includes/header.php' ?>

<div class="placeorder content-wrapper" style="margin-bottom:100px">
    <br>
    <?php if (empty($products)) : ?>
        <h1>There is no order</h1>
        <p>Please put some product into cart. If there are some problems, contact us by the email. </p>
    <?php else : ?>

        <h1>Your Order Has Been Placed</h1>
        <p>Thank you for ordering with us, we'll contact you by email with your order details.</p>
    <?php endif; ?>
</div>
<div class="container">
    <div class="row">
        <h1 style="text-align:center;">Order details</h1>
        <div class="col-md-6">

            <table class="table table-bordered">

                <?php if (empty($products)) : ?>
                    <tr>
                        <td colspan="6" style="text-align:center;">There is no order.</td>
                    </tr>
                <?php else : ?>
                    <tr>
                        <td class="table-row">Order ID</td>
                        <td style="text-align:center;"><?php echo $order['order_id']; ?></td>

                    </tr>
                    <tr>
                        <td class="table-row">Payment</td>
                        <td style="text-align:center;"><?php echo $payment['name']; ?></td>
                    </tr>
                    <tr>
                        <td class="table-row">Shipping</td>
                        <td style="text-align:center;"><?php echo $shipping['name']; ?></td>
                    </tr>
                <?php endif; ?>
            </table>
        </div>
        <div class="col-md-6">
            <table class="table table-bordered">

                <?php if (empty($products)) : ?>
                    <tr>
                        <td colspan="6" style="text-align:center;">There is no order.</td>
                    </tr>
                <?php else : ?>
                    <tr>
                        <td class="table-row">Date</td>
                        <td style="text-align:center;"><?php $newDate = date("d.m.Y H:i", strtotime($order['date']));
                                                        echo $newDate; ?></td>

                    </tr>
                    <tr>
                        <td class="table-row">Email</td>
                        <td style="text-align:center;"><?php echo $userEmail; ?></td>
                    </tr>
                    <tr>


                        <td class="table-row">Total</td>
                        <td style="text-align:center; font-weight:600;"><?php echo $total; ?> CZK</td>
                    </tr>
                <?php endif; ?>
            </table>
        </div>

        <br>
        <h2 style="text-align:center;">Product details</h2>
        <br>
        <div class="col-md-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <td class="table-row" colspan="2">Product</td>
                        <td class="table-row">Price</td>
                        <td class="table-row">Quantity</td>
                        <td class="table-row">Total</td>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($products)) : ?>
                        <tr>
                            <td colspan="6" style="text-align:center;">You have no products added to your order.</td>
                        </tr>
                    <?php else : ?>
                        <?php foreach ($products as $product) : ?>
                            <tr>
                                <td class="img" style="text-align:center;">
                                    <img src="img/<?php echo $product['name']; ?>.png" width="50" height="50" alt="img/<?php echo $product['name']; ?>.png">
                                </td>
                                <td style="text-align:center;">
                                    <?= $product['name'] ?>
                                </td>
                                <td style="text-align:center;" class="price"><?= $product['price'] ?> CZK</td>
                                <td style="text-align:center;" class="quantity"><?= $products_in_cart[$product['product_id']] ?>
                                </td>
                                <td style="text-align:center;" class="price"><?= $product['price'] * $products_in_cart[$product['product_id']] ?> CZK</td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>
    <div style="margin-bottom:300px;"></div>
</div>
<?php unset($_SESSION['cart']); ?>
<?php include __DIR__ . '/includes/footer.php'
?>
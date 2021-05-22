<?php require_once __DIR__ . '/class/PaymentDB.php'; ?>
<?php require_once __DIR__ . '/class/ShippingDB.php'; ?>
<?php require_once __DIR__ . '/class/ProductsDB.php'; ?>
<?php require_once __DIR__ . '/class/UsersDB.php'; ?>
<?php require_once __DIR__ . '/class/OrdersDB.php'; ?>
<?php require_once __DIR__ . '/class/OrderProductDB.php'; ?>
<?php

$ordersDB = new OrdersDB();
$orderProductDB = new OrderProductDB();
if (isset($_GET['id'])) {
    $order = $ordersDB->fetchById(htmlspecialchars($_GET['id']));
    $productIds = $orderProductDB->fetchById(htmlspecialchars($_GET['id']));
}

$productsDB = new ProductsDB();
$shippingDB = new ShippingDB();
$paymentDB = new PaymentDB();



?>
<?php include __DIR__ . '/includes/header.php' ?>
<?php include __DIR__ . '/includes/navigationProfile.php' ?>
<div class="container">
    <div class="row">
        <br>
        <h1 style="text-align:center; text-transform:uppercase;">Order details</h1>
        <br>
        <div class="col-md-6">

            <table class="table table-bordered">

                <?php if (empty($order)) : ?>
                    <tr>
                        <td colspan="6" style="text-align:center;">There is no order.</td>
                    </tr>
                <?php else : ?>
                    <tr>
                        <td class="table-row">Order ID</td>
                        <td style="text-align:center;" colspan="2"><?php echo $order['order_id']; ?></td>

                    </tr>
                    <tr>
                        <td class="table-row">Payment</td>
                        <?php $payment = $paymentDB->fetchById($order['payment_id']); ?>

                        <td style="text-align:center;"><?php echo $payment['name']; ?></td>
                        <td style="text-align:center;"><?php echo $payment['price']; ?> CZK</td>
                    </tr>
                    <tr>
                        <td class="table-row">Shipping</td>
                        <?php $shipping = $shippingDB->fetchById($order['shipping_id']); ?>

                        <td style="text-align:center;"><?php echo $shipping['name']; ?></td>
                        <td style="text-align:center;"><?php echo $shipping['price']; ?> CZK</td>
                    </tr>
                <?php endif; ?>
            </table>
        </div>
        <div class="col-md-6">
            <table class="table table-bordered">

                <?php if (empty($order)) : ?>
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
                        <td style="text-align:center;"><?php echo $order['email']; ?></td>
                    </tr>
                    <tr>


                        <td class="table-row">Total</td>
                        <td style="text-align:center;"><?php echo $order['amount']; ?> CZK</td>

                    </tr>
                <?php endif; ?>
            </table>
        </div>
        <br>
        <div class="col-md-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <td class="table-row">Full Name</td>
                        <td class="table-row">Address</td>
                        <td class="table-row">City</td>
                        <td class="table-row">Country</td>
                        <td class="table-row">Zipcode</td>
                        <td class="table-row">Phone</td>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($order)) : ?>
                        <tr>
                            <td colspan="6" style="text-align:center;">You have no orders.</td>
                        </tr>
                    <?php else : ?>
                        <tr>

                            <td style="text-align:center;"><?php echo $order['firstName']; ?> <?php echo $order['lastName']; ?></td>
                            <td style="text-align:center;"><?php echo $order['address']; ?></td>
                            <td style="text-align:center;"><?php echo $order['city']; ?></td>
                            <td style="text-align:center;"><?php echo $order['country']; ?></td>
                            <td style="text-align:center;"><?php echo $order['zipcode']; ?></td>
                            <td style="text-align:center;"><?php echo $order['phone']; ?></td>
                        </tr>

                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <br>
        <h2 style="text-align:center;text-transform:uppercase;">Product details</h2>
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
                    <?php if (empty($productIds)) : ?>
                        <tr>
                            <td colspan="6" style="text-align:center;">You have no products added to your order.</td>
                        </tr>
                    <?php else : ?>

                        <?php foreach ($productIds as $productId) : ?>
                            <?php $orderProducts = $orderProductDB->fetchAllById($productId['product_id'], $order['order_id']); ?>
                            <?php foreach ($orderProducts as $orderProduct) : ?>
                                <?php $product = $productsDB->fetchById($productId['product_id']); ?>

                                <tr>
                                    <td class="img" style="text-align:center;">
                                        <img src="img/<?php echo $product['name']; ?>.png" width="50" height="50" alt="img/<?php echo $product['name']; ?>.png">
                                    </td>
                                    <td style="text-align:center;">
                                        <?= $product['name'] ?>
                                    </td>
                                    <td style="text-align:center;" class="price"><?= $product['price'] ?> CZK</td>

                                    <td style="text-align:center;" class="quantity"><?= $orderProduct['quantity']; ?>
                                    </td>
                                    <td style="text-align:center;" class="price"><?= $product['price'] * $orderProduct['quantity'] ?> CZK</td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>
</div>

<div style="margin-bottom:100px;"></div>
<?php include __DIR__ . '/includes/footer.php' ?>
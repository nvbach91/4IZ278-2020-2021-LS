<?php require __DIR__ . '/incl/header.php'; ?>
<?php require __DIR__ . '/incl/navbar.php'; ?>
<?php require __DIR__ . '/db/OrderDB.php'; ?>
<?php require __DIR__ . '/db/ProductsDB.php'; ?>
<?php require __DIR__ . '/components/global.php'; ?>
<?php
require 'components/userRequired.php';

$ordersDB = new OrdersDB();
$orders = $ordersDB->fetchUserOrders($me->getId());
// get products for order, grouped by name
for ($i = 0; $i < count($orders); $i++) {
    $productsDB = new ProductsDB();
    $products = $productsDB->fetchProductsByOrder($orders[$i]['order_id']);
    $orders[$i]['order_products'] = $products;
}
// get quantity of each product in order
for ($i = 0; $i < count($orders); $i++) {
    $orderProducts = $orders[$i]['order_products'];
    $newProducts = [];
    for ($j = 0; $j < count($orderProducts); $j++) {
        $pcs = $productsDB->fetchOrderProductPcs($orderProducts[$j]['product_name'], $orderProducts[$j]['order_order_id']);
        $orderProducts[$j]['pcs'] = $pcs;
        array_push($newProducts, $orderProducts[$j]);
    }
    $orders[$i]['order_products'] = $newProducts;
}

function getDeliveryMethod($method)
{
    switch ($method) {
        case 'personalCollection':
            return 'personal collection';
        case 'homeDelivery':
            return 'home delivery (+3$)';
    }
}
function getPaymentMethod($method)
{
    switch ($method) {
        case 'bankTransfer':
            return 'bank transfer';
        case 'cashOnHomeDelivery':
            return 'cash on home delivery (+1$)';
        case 'cashOnPersonalCollection':
            return 'cash on collection';
    }
}
?>
<div class="my-orders">
    <?php if (@$orders) : ?>
        <h1>Your orders:</h1>
        <?php foreach ($orders as $row) : ?>
            <div class="card mb-3 cart-card">
                <div class="row g-0">
                    <div class="col-md-12">
                        <div class="card-body">
                            <h5 class="card-title">Order number: <?php echo htmlspecialchars($row['order_id'], ENT_QUOTES, 'UTF-8') ?> | Date: <?php echo  htmlspecialchars($row['order_date'], ENT_QUOTES, 'UTF-8') ?> | Value: <?php echo htmlspecialchars($row['order_value'], ENT_QUOTES, 'UTF-8') ?> <?php echo (GLOBAL_CURRENCY) ?></h5>
                            <hr>
                            <p>Items:</p>
                            <?php foreach ($row['order_products'] as $product) : ?>
                                <div class="img-with-info">
                                    <img src="<?php echo $product['product_img'] ?>" alt="<?php echo htmlspecialchars($product['product_name'], ENT_QUOTES, 'UTF-8') ?>">
                                    <div class="info">
                                        <p><?php echo htmlspecialchars($product['product_name'], ENT_QUOTES, 'UTF-8') ?></p>
                                        <span class="badge bg-primary rounded-pill"><?php echo $product['pcs'] . 'X' ?></span>
                                        <span>for <?php echo htmlspecialchars($product['product_price'] * $product['pcs'], ENT_QUOTES, 'UTF-8') ?> <?php echo (GLOBAL_CURRENCY) ?></span>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <hr>
                            <div class="delivery-payment">
                                <span>Delivery: <?php echo htmlspecialchars(getDeliveryMethod($row['delivery_method']), ENT_QUOTES, 'UTF-8') ?> </span>
                                <span>Payment: <?php echo htmlspecialchars(getPaymentMethod($row['payment_method']), ENT_QUOTES, 'UTF-8') ?> </span>
                            </div>
                            <form action="components/cancelOrder.php" method="POST">
                                <input class="d-none" name="id" value="<?php echo htmlspecialchars($row['order_id'], ENT_QUOTES, 'UTF-8') ?>">
                                <button type="submit" class="btn btn-danger btn-remove-item">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <h5 class="color-white no-orders">No orders :(</h5>
    <?php endif; ?>
</div>
<?php require __DIR__ . '/incl/footer.php' ?>
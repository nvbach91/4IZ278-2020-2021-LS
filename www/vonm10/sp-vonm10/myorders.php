<?php require_once __DIR__ . '/db/ProductsDB.php'; ?>
<?php require_once __DIR__ . '/db/UsersDB.php'; ?>
<?php require_once __DIR__ . '/db/OrdersDB.php'; ?>
<?php


$productsDB = new ProductsDB();
$usersDB = new UsersDB();
$ordersDB = new OrdersDB();

session_start();
$anyOrders = false;

if ($_SESSION) {
    if ($_SESSION['login']) {
        $userId = $_SESSION['user_id'];
        $allUserOrders = $ordersDB->fetchOrdersWithoutTimestamp($userId);
        if (count($allUserOrders) >= 1) {
            $anyOrders = true;

            $output = array();
            foreach ($allUserOrders as $key => $item) {
                $output[$item['timestamp']][$key] = $item;
            }

            ksort($output, SORT_NUMERIC);
        }
    }
}



?>

<?php require __DIR__ . '/incl/header.php'; ?>
<h4 class="card-title">My orders</h4>
<hr>
<ul>
    <?php foreach ($output as $order) : ?>
        <li>
        <?php $timestamp; $totalPrice = 0;?>
            <?php foreach ($order as $suborder) : ?>
                <?php $product = $productsDB->fetch($suborder['product_id'])?>
                <div><a href = "<?php echo URL . '/products/product.php?id=' . $product['id'] ?>"><?php echo $product['name'] . '(id=' . $product['id'] . ')'; ?></a></div>
                <div>Price: <?php echo $product['price']; ?> eur</div>
                <?php $timestamp = $suborder['timestamp'];
                $totalPrice += $product['price'];?>
            <?php endforeach ?>
            <div>Total price: <?php echo $totalPrice ?> eur</div>
            <div><?php echo $timestamp ?></div>
        </li>
        <hr>
    <?php endforeach ?>
</ul>

<?php require __DIR__ . '/incl/footer.php'; ?>
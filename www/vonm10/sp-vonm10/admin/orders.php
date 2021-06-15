<?php require_once __DIR__ . '/../db/OrdersDB.php'; ?>
<?php require_once __DIR__ . '/../db/ProductsDB.php'; ?>
<?php
session_start();
if (!$_SESSION['admin'] || $_SESSION['admin'] == 1) {
    header('Location: /./~vonm10/beardwithme/index.php');
}

$now = date_create('now')->format('Y-m-d H:i:s');
$ordersDB = new OrdersDB();
$productsDB = new ProductsDB();
$invalidInputs = [];
$isValidForm = false;

if (!empty($_GET)) {
    $userId = htmlspecialchars(trim($_GET['userId']));
    $timestamp = date("Y-m-d H:i:s", strtotime($_GET['timestamp']));

    if (!$userId) {
        array_push($invalidInputs, 'ID is empty');
    }
    if (!preg_match('/^[0-9]*$/', $userId)) {
        array_push($invalidInputs, 'ID has to be an integer');
    }

    $isValidForm = count($invalidInputs) == 0;

    $orders = [];
    $products = [];

    if ($isValidForm) {
        $orders = $ordersDB->fetchOrders($userId, $timestamp);
        foreach ($orders as $order) {
            array_push($products, $productsDB->fetch($order['product_id']));
        }
    }
}
$totalPrice = 0;


?>

<?php require __DIR__ . '/../incl/header.php'; ?>
<h1>Orders</h1>
<?php foreach ($invalidInputs as $invalidInput) : ?>
    <p><?php echo $invalidInput; ?>
    <?php endforeach ?>
    <form method="GET">
        <div>
            <label>User ID:</label>
            <input name="userId">
        </div>
        <div>
            <label>Timestamp:</label>
            <input name="timestamp" type="datetime-local" value="<?php echo $now ?>">
        </div>
        <div>
            <input type="submit" value="Confirm">
        </div>
    </form>
    <? if ($isValidForm) : ?>
        <div>User: <?php echo $userId ?></div>
        <div>Timestamp: <?php echo $timestamp ?></div>
        <ul>
            <?php foreach ($products as $product) : ?>
                <li>
                    <div><?php echo $product['name'] . '(id=' . $product['id'] . ')'; ?></div>
                    <div>
                        <div>Price: <?php echo $product['price'] ?></div>
                    </div>
                </li>
                <?php $totalPrice = $totalPrice + $product['price'] ?>
            <?php endforeach ?>
        </ul>
        <hr>
        <div>Total price = <?php echo $totalPrice ?></div>
    <? else : ?>
        <div>Invalid form</div>
    <? endif; ?>
    <?php require __DIR__ . '/../incl/footer.php'; ?>
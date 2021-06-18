<?php require_once __DIR__ . '/../db/OrdersDB.php'; ?>
<?php require_once __DIR__ . '/../db/ProductsDB.php'; ?>
<?php
session_start();
if (!$_SESSION['admin'] || $_SESSION['admin'] == 1) {
    header('Location: /./~vonm10/beardwithme/index.php');
    die('Invalid permission');
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

    if(!$timestamp){
        array_push($invalidInputs, 'Timestamp is empty');
    }
    if (!preg_match('/\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}/', $timestamp)) {
        array_push($invalidInputs, 'Timestamp is in incorrect format');
    }


    $isValidForm = count($invalidInputs) == 0;

    $orders = [];
    $products = [];

    if ($isValidForm) {
        $orders = $ordersDB->fetchOrders($userId, $timestamp);
        foreach ($orders as $order) {
            array_push($products, $productsDB->fetch($order['product_id']));
            $payment = $order['payment'];
            $delivery = $order['delivery'];
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
        <div>Payment method: <?php echo $payment ?></div>
        <div>Delivery method: <?php echo $delivery ?></div>
        <ul>
            <?php foreach ($products as $product) : ?>
                <li>
                    <div><?php echo $product['name'] . '(id=' . $product['id'] . ')'; ?></div>
                    <div>
                        Price: <?php echo $product['price'] ?>
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
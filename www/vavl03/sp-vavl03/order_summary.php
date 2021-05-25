<?php require __DIR__ . '/incl/header.php' ?>
<?php require __DIR__ . '/incl/navbar.php' ?>
<?php require __DIR__ . '/components/global.php'; ?>
<?php require __DIR__ . '/db/ProductsDB.php'; ?>
<?php
require 'components/userRequired.php';

if (isset($_SESSION['orderSent'])) {
    header('Location: ../sp-vavl03/index.php');
    exit();
}

$userName = $_SESSION['userName'];
$userEmail = $_SESSION['userEmail'];
$userStreet = $_SESSION['userStreet'];
$userDescNumber = $_SESSION['userDescNumber'];
$userCity = $_SESSION['userCity'];
$userState = $_SESSION['userState'];
$userZip = $_SESSION['userZip'];
$userNumber = $_SESSION['userNumber'];

switch ($_SESSION['delivery']) {
    case 'personalCollection':
        $deliveryMethod = 'Personal collection';
        break;
    case 'homeDelivery':
        $deliveryMethod = 'Home delivery (+3$)';
        break;
}
if ($_SESSION['delivery'] === 'homeDelivery' && $_SESSION['payment'] === 'cashOnHomeDelivery') {
    $deliveryCosts = 4;
} else if ($_SESSION['delivery'] === 'homeDelivery' && $_SESSION['payment'] != 'cashOnHomeDelivery') {
    $deliveryCosts = 3;
} else {
    $deliveryCosts = 0;
}
switch ($_SESSION['payment']) {
    case 'bankTransfer':
        $paymentMethod = 'Bank transfer';
        break;
    case 'cashOnHomeDelivery':
        $paymentMethod = 'Cash on home delivery (+1$)';
        break;
    case 'cashOnPersonalCollection':
        $paymentMethod = 'Cash on personal collection';
        break;
}
$productIds = [];
foreach ($_SESSION['cart'] as $key => $value) {
    array_push($productIds, $key);
}
$productsDB = new ProductsDB();
$cardsToShow = [];
foreach ($productIds as $id) {
    $productToDisplay = $productsDB->fetchById($id);
    foreach ($_SESSION['cart'] as $key => $value) {
        if ($key === $productToDisplay['product_id']) {
            $productToDisplay['product_pcs'] = $value;
        }
    }
    array_push($cardsToShow, $productToDisplay);
}
// get total price with delivery costs
$totalSum = 0;
foreach ($cardsToShow as $card) {
    $price = $card['product_price'] * (int)$card['product_pcs'];
    $totalSum += $price;
}
$totalSum += $deliveryCosts;
$_SESSION['orderValue'] = $totalSum;

// gets total price of product based on quantity
function getPrice($productName, $pcs)
{
    $productsDB = new ProductsDB();
    $productPrice = $productsDB->fetchProductPrice($productName) * $pcs;
    return $productPrice;
}
?>

<div class="order-summary">
    <h1>Order summary:</h1>
    <div class="costs">
        <ul class="list-group">
            <?php foreach ($cardsToShow as $card) : ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span class="summary-product-name-price"><span><?php echo htmlspecialchars($card['product_name'], ENT_QUOTES, 'UTF-8') ?></span> <span class="product-summary-price color"><?php echo htmlspecialchars($card['product_price'] * (int)$card['product_pcs'], ENT_QUOTES, 'UTF-8') . ' ' . GLOBAL_CURRENCY ?></span></span>
                    <span class="badge bg-primary rounded-pill"><?php echo htmlspecialchars($card['product_pcs'], ENT_QUOTES, 'UTF-8') . 'X' ?></span>
                </li>
            <?php endforeach; ?>
        </ul>
        <h4 class="total-price color">Total price: <?php echo htmlspecialchars($totalSum, ENT_QUOTES, 'UTF-8'), ' ', GLOBAL_CURRENCY; ?></h4>
        <p>Delivery costs: <?php echo htmlspecialchars($deliveryCosts, ENT_QUOTES, 'UTF-8'), ' ', GLOBAL_CURRENCY; ?></p>
    </div>
    <hr class="hr">
    <div class="delivery-details-summary">
        <h4>Delivery details:</h4>
        <ul class="list-group">
            <li class="list-group-item"><?php echo htmlspecialchars($userName, ENT_QUOTES, 'UTF-8') ?></li>
            <li class="list-group-item"><?php echo htmlspecialchars($userEmail, ENT_QUOTES, 'UTF-8') ?></li>
            <li class="list-group-item"><?php echo htmlspecialchars($userStreet, ENT_QUOTES, 'UTF-8') ?></li>
            <li class="list-group-item"><?php echo htmlspecialchars($userDescNumber, ENT_QUOTES, 'UTF-8') ?></li>
            <li class="list-group-item"><?php echo htmlspecialchars($userCity, ENT_QUOTES, 'UTF-8') ?></li>
            <li class="list-group-item"><?php echo htmlspecialchars($userState, ENT_QUOTES, 'UTF-8') ?></li>
            <li class="list-group-item"><?php echo htmlspecialchars($userZip, ENT_QUOTES, 'UTF-8') ?></li>
            <li class="list-group-item"><?php echo htmlspecialchars($userNumber, ENT_QUOTES, 'UTF-8') ?></li>
        </ul>
    </div>
    <hr class="hr">
    <div class="methods-summary">
        <h5>Payment method: <span class="color"><?php echo htmlspecialchars($paymentMethod, ENT_QUOTES, 'UTF-8') ?></span></h5>
        <?php if (@$_SESSION['payment'] === 'bankTransfer') : ?>
            <p><em>Please note that cards will be shiped after we register succesful bank transfer.</em></p>
            <div class="bank-transfer">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td>Account number</td>
                            <td>999999999/0333</td>
                        </tr>
                        <tr>
                            <td>Amount</td>
                            <td><?php echo htmlspecialchars($totalSum, ENT_QUOTES, 'UTF-8') ?> $</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
        <hr class="hr">
        <h5>Delivery method: <span class="color"><?php echo htmlspecialchars($deliveryMethod, ENT_QUOTES, 'UTF-8') ?></span></h5>
        <?php if (@$_SESSION['delivery'] === 'personalCollection') : ?>
            <div class="shop-location-info">
                <p>You will find us here:
                <p>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d638.5224401782452!2d13.653091329246083!3d50.19685309871508!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x470a478557aff26b%3A0xa7421886956f571a!2zUG92bMSNw61uIDE1OSwgMjcwIDA0IE1pbG9zdMOtbg!5e0!3m2!1scs!2scz!4v1619890461117!5m2!1scs!2scz" class="map" allowfullscreen="" loading="lazy"></iframe>
                <p><em>We are open 24/7, 365 days. Come anytime you want.</em></p>
            </div>
        <?php endif; ?>
    </div>
    <div class="delivery-btns">
        <a href="delivery_details.php" class="btn btn-secondary btn-lg">Back</a>
        <form action="components/completeOrder.php">
            <input type="submit" class="btn btn-primary btn-lg" value="Send order"></button>
        </form>
    </div>
</div>
<?php require __DIR__ . '/incl/footer.php' ?>
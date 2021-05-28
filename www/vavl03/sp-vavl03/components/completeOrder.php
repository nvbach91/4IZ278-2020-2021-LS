<?php require __DIR__ . '/../db/OrderDB.php'; ?>
<?php require __DIR__ . '/../db/ProductsDB.php'; ?>
<?php require __DIR__ . '/../db/UsersDB.php'; ?>
<?php
session_start();

$boughtProducts = [];
foreach ($_SESSION['cart'] as $key => $value) {
    array_push($boughtProducts, (int) $value);
}
$numberOfBoughtProducts = array_sum($boughtProducts);
$productsDB = new ProductsDB();
$helperArr = [];
foreach ($_SESSION['cart'] as $key => $value) {
    $ids = $productsDB->fetchProductIds($key, $value);
    array_push($helperArr, $ids);
}
$productIds = [];
foreach ($helperArr as $product) {
    foreach ($product as $a) {
        foreach ($a as $key => $value) {
            array_push($productIds, $value);
        }
    }
}
if ($numberOfBoughtProducts != count($productIds)) {
    // destroy session except fb token
    unset($_SESSION['cart']);
    unset($_SESSION['delivery']);
    unset($_SESSION['orderValue']);
    unset($_SESSION['payment']);
    unset($_SESSION['userCity']);
    unset($_SESSION['userDescNumber']);
    unset($_SESSION['userEmail']);
    unset($_SESSION['userName']);
    unset($_SESSION['userNumber']);
    unset($_SESSION['userState']);
    unset($_SESSION['userStreet']);
    unset($_SESSION['userZip']);
    unset($_SESSION['productsToShow']);
    header('Location: ../products_gone.php');
    exit();
} else {
    require_once __DIR__ . '/../vendor/autoload.php';
    require_once __DIR__ . '/../facebook-login/config.php';
    require_once __DIR__ . '/../email/utils.php';
    $fb = new \Facebook\Facebook(array_merge(CONFIG_FACEBOOK, ['default_access_token' => $_SESSION['fb_access_token']]));
    try {
        $me = $fb->get('/me')->getGraphUser();
    } catch (\Facebook\Exceptions\FacebookResponseException $e) {
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
    } catch (\Facebook\Exceptions\FacebookSDKException $e) {
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
    }
    // send email 
    sendEmail($_SESSION['userEmail'], 'Order confirmation');

    // create order in db
    $date = date("Y-m-d");
    $ordersDB = new OrdersDB();
    $order = $ordersDB->createOrder($_SESSION['orderValue'], $me->getId(), $date, $_SESSION['delivery'], $_SESSION['payment'], $productIds);

    // update user info
    $usersDB = new UsersDB();
    $user = $usersDB->updateUser(
        $_SESSION['userEmail'],
        $_SESSION['userName'],
        $_SESSION['userNumber'],
        $_SESSION['userStreet'],
        $_SESSION['userDescNumber'],
        $_SESSION['userCity'],
        $_SESSION['userZip'],
        $_SESSION['userState'],
        $me->getId()
    );
    
    // destroy session except fb token
    unset($_SESSION['cart']);
    unset($_SESSION['delivery']);
    unset($_SESSION['orderValue']);
    unset($_SESSION['payment']);
    unset($_SESSION['userCity']);
    unset($_SESSION['userDescNumber']);
    unset($_SESSION['userEmail']);
    unset($_SESSION['userName']);
    unset($_SESSION['userNumber']);
    unset($_SESSION['userState']);
    unset($_SESSION['userStreet']);
    unset($_SESSION['userZip']);
    unset($_SESSION['productsToShow']);

    $_SESSION['orderSent'] = true;
    header('Location: ../thanks.php');
    exit();
}
?>

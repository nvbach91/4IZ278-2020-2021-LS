<?php require __DIR__ . '/../db/OrderDB.php'; ?>
<?php require __DIR__ . '/../db/ProductsDB.php'; ?>
<?php
session_start();
// check if someone else haven't already bought users items
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
$productIds = []; // ID's of all products that are bought and are not already bought by someone else
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
    header('Location: ../products_gone.php');
    exit();
} else {
    // send email
    // AŽ JAKO POSLEDNÍ VĚC to udělej!! NEJDE POSÍLAT MAILY Z LOCALHOSTU, JELIKOŽ TO BUDE NA ESO.VSE.CZ TAK PŮJDE POSÍLAT MAILY JEN NA @VSE, SOUBORY READY VE FOLDERU email

    

require_once __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../facebook-login/config.php';
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
$date = date("Y-m-d");
// create order in db
$ordersDB = new OrdersDB();
$order = $ordersDB->createOrder($_SESSION['orderValue'],$me->getId(),$date,$_SESSION['delivery'],$_SESSION['payment'],$productIds);
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
/* prevent user from coming back into the order process, force him to start new order by redirecting him to index.php
 in each order process page, $_SESSION['orderSent'] is unset in startNewOrder.php*/
$_SESSION['orderSent'] = true;
header('Location: ../thanks.php');
exit();
}



?>
<script>
    console.log(<?php echo (json_encode($_SESSION)) ?>);
    console.log(<?php echo (json_encode($numberOfBoughtProducts)) ?>);
    console.log(<?php echo (json_encode(count($productIds))) ?>);
</script>

<div><?php //var_dump($me->getId())
        ?></div>
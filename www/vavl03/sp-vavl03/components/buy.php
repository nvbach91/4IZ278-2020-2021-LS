<?php require __DIR__ . '/../db/ProductsDB.php'; ?>
<?php
session_start();

# session pole pro kosik
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}
# kontrola existence id, aby do url nešlo dát cokoliv
$productDB = new ProductsDB();
$id = $_GET['id'];
$products = $productDB->fetchById($id);
if (!$products){
    exit("Unable to find goods!");
}
# TODO neresime, ze od jednoho zbozi muze byt vetsi mnozstvi nez 1, domaci ukol :)


# pridame id zbozi do session pole pouze pokud tam už není
$alreadyInCart = array_key_exists($id,$_SESSION['cart']);
if(!$alreadyInCart){
    //$_SESSION['cart'][] = $products["product_id"];
    $_SESSION['cart'][$products["product_id"]] = "1";
    //require 'userRequired.php';
    header('Location: ../cart.php');
    exit();
}else{
    header('Location: ../cart.php');
    //require 'userRequired.php';
    exit();
}
   

?> 
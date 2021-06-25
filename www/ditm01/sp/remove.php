<?php require __DIR__ . '/db/db.php'; ?>
<?php
if(!isset($_SESSION)){
    session_start();
}

$id = @$_GET['id'];
foreach ($_SESSION['cart'] as $key => $value) {
    if ($value == $id) {
        unset($_SESSION['cart'][$key]);
    }
}

header('Location: cart.php');
exit();
?>
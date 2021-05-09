<?php
session_start();
# zrusime id zbozi ze session
# nekontrolujeme, jestli tam je
$id = @$_POST['id'];
#var_dump($_SESSION['cart']);
foreach ($_SESSION['cart'] as $key => $value){
    if ($key == $id) {
        unset($_SESSION['cart'][$key]);
    }
}
header('Location: ../cart.php');
exit();
?>
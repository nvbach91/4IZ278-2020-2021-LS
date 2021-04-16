
<?php 
    session_start();
    $id = $_GET['id'];
    
    $index = array_search($id, $_SESSION['cart']);

    if ($index !== false) {
        unset($_SESSION['cart'][$index]);
    }

    header('Location: cart.php');

?>

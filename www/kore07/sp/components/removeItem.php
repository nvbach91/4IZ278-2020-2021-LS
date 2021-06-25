<?php require_once __DIR__ . '/../database/ProductsDB.php'; ?>
<?php

    session_start();

    $productsDB = new ProductsDB();

    $id = $_GET['id'];

    foreach ($_SESSION['cart'] as $key => $value) {
        if ($_SESSION['cart'][$key]['id'] == $id) {
            $sets = array(
                'product_quantity' => 1,
            );
            
            $wheres = array(
                'product_id' => $_SESSION['cart'][$key]['id'],
            ); 
            
            $productsDB->updateBy($wheres, $sets);

            unset($_SESSION['cart'][$key]);
        }
    }

    header('Location: ../cart.php');
    exit(); 

?>
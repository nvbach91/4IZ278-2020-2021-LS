<?php require_once __DIR__ .'/../utils/utils.php'; ?>
<?php require_once __DIR__ . '/../database/OrdersDB.php'; ?>
<?php require_once __DIR__ . '/../database/ProductsDB.php'; ?>
<?php require_once __DIR__ . '/../database/OrdersProductsDB.php'; ?>
<?php

    if(!isset($_SESSION)){
        session_start();
    }

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $ordersDB = new OrdersDB();

    $orderArgs = array(
        'date' => $_SESSION['order_info']['date'],
        'delivery' => $_SESSION['order_info']['delivery'],
        'payment' => $_SESSION['order_info']['payment'],
        'total' => $_SESSION['order_info']['total'],
        'user_id' => $_SESSION['user_id']
    );

    $ordersDB->create($orderArgs);
    $orderID = $ordersDB->findLastID();

    $ordersProductsDB = new OrdersProductsDB();

    // print("SESSION CART <br>");
    // print_r($_SESSION['cart']);

    foreach ($_SESSION['cart'] as $key=>$value) {
        $orderProductArgs = [
            'order_id' => $orderID,
            'product_id' => $_SESSION['cart'][$key]['id'],
            'product_quantity' => $_SESSION['cart'][$key]['qnt'],
        ];

        // print("orderproduct ARGS <br>");
        // print_r($orderProductArgs); 
        // print("<br>");

        $ordersProductsDB->create($orderProductArgs);

    }


    sendEmail($_SESSION['user_email'], 'Order confirmation');
    $productsDB = new ProductsDB();
    foreach ($_SESSION['cart'] as $key=>$value) {
            $_SESSION['cart'][$key]['qnt'] = 1;

            $sets = array(
                'product_quantity' => $_SESSION['cart'][$key]['qnt'],
            );

            $wheres = array(
                'product_id' => $_SESSION['cart'][$key]['id'],
            ); 

            $productsDB->updateBy($wheres, $sets);
    }
    $_SESSION['cart'] = [];
    header('Location: ../success.php');
?>
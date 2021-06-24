<?php require_once __DIR__ .'/../utils/utils.php'; ?>
<?php require_once __DIR__ . '/../database/OrdersDB.php'; ?>
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

    foreach ($_SESSION['cart'] as $key=>$value) {
        $orderProductArgs = [
            'order_id' => $orderID,
            'product_id' => $_SESSION['cart'][$key]['id'],
        ];

        $ordersProductsDB->create($orderProductArgs);
    }


    sendEmail($_SESSION['user_email'], 'Order confirmation');
    $_SESSION['cart'] = [];
    header('Location: ../success.php');
?>
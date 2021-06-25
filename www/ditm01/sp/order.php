<?php require __DIR__ . '/db/productsDB.php'; ?>
<?php require __DIR__ . '/db/ordersDB.php'; ?>
<?php require __DIR__ . '/db/usersDB.php'; ?>
<?php require __DIR__ . '/db/ordersProductsDB.php'; ?>
<?php

    if(!isset($_SESSION)){
        session_start();
    }

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $productsDB = new ProductsDB();
    $ordersDB = new OrdersDB();
    $usersDB = new UsersDB();
    $ordersProductsDB = new OrdersProductsDB();

    $orderInfo = array(
        'date' => $_SESSION['deliveryInfo']['date'],
        'delivery' => $_SESSION['deliveryInfo']['delivery'],
        'payment' => $_SESSION['deliveryInfo']['payment'],
        'total_price' => $_SESSION['deliveryInfo']['total_price'],
        'user_id' => $_SESSION['user_id']
    );

    $order = $ordersDB->createOrder($orderInfo);
    $order_id = $ordersDB->findLastOrderID();

    foreach ($_SESSION['cart'] as $key=>$product) {
        $orderContent = [
            'order_id' => $order_id,
            'product_id' => $product
        ];
        $ordersProduct = $ordersProductsDB->createOrderProducts($orderContent);
    }

    $userInfo = array(
        'address' => $_SESSION['deliveryInfo']['address'],
        'zip' => $_SESSION['deliveryInfo']['zip'],
        'city' => $_SESSION['deliveryInfo']['city'],
        'country' => $_SESSION['deliveryInfo']['country'],
        'phone' => $_SESSION['deliveryInfo']['phone'],
        'user_id' => $_SESSION['user_id']
    );


    $usersDB->updateUser($userInfo);

    unset($_SESSION['cart']);
    header('Location: index?ref=order');
?>
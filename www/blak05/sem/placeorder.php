<?php
    session_start();
    require __DIR__ . '/db/orderDB.php';
    require __DIR__ . '/db/usersDB.php';
    require __DIR__ . '/db/shippingDB.php'; 
    require __DIR__ . '/db/paymentsDB.php';
    require __DIR__ . '/db/orderproductDB.php';

    if (!empty($_POST)) {

        $id_shipping = $_POST['id_shipping'];
        $id_payment = $_POST['id_payment'];
        $shippingDB = new ShippingDB();
        $shipping = $shippingDB->fetch($id_shipping);
        $paymentsDB = new PaymentsDB();
        $payment = $paymentsDB->fetch($id_payment);
        $userid = $_SESSION["user"];
        $usersDB = new UsersDB();
        $user = $usersDB->fetch($userid);
        
        
        $ID_User = $user['ID_User'];
        $total_price = $_SESSION['price'] + $shipping["price"] + $payment["price"];
        $date = date("Y/m/d");
        $ordersDB = new OrderDB();
        $order = $ordersDB->create([$ID_User, $total_price, $date, $id_shipping, $id_payment]);
        $productsCart = $_SESSION['cart'];
        foreach($productsCart as $productCart){
            $ordersDB = new OrderDB();
            $last = $ordersDB->fetchLast();
            $lastID = $last["id_order"];
            $orderproductDB = new OrderProductDB();
            $orderproduct = $orderproductDB->create([$productCart, $lastID]);
        }

        $to = $user["email"];
        $subject = 'Objednávka číslo'. $order["id_order"] ;
        $txt = 'Dobrý den, děkujeme za Vaši objednávku!' . '\r\n' . 'Celková výše objednávky je '. $total_price . ' Kč.';
        $headers = "From: info@pivoteka.cz";
        mail($to,$subject,$txt,$headers);
        
        unset($_SESSION['cart']);
        header('Location: index.php');
    }
?>
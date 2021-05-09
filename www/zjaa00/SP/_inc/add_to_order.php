<?php
  require "./config.php";

  require "./require_user.php";
  
  $email = $_COOKIE['email'];

  $open_order = $connect->prepare('
    SELECT drinks_orders.drink_id, drinks_orders.order_id, amount
    FROM orders
    JOIN drinks_orders
        on drinks_orders.order_id = orders.order_id
    WHERE open = 1 AND drinks_orders.email = :email;
  ');
  $open_order->execute(['email' => $email]);
  $open_order = $open_order->fetchAll(PDO::FETCH_UNIQUE|PDO::FETCH_ASSOC);
  
  @$order_id = $open_order[array_keys($open_order)[0]]['order_id'];
  
  if (@$_POST['order']) {
    
    if(!$open_order) {
      $insert = $connect->prepare('
        INSERT INTO orders (email, created_at, open)
        VALUES (:email, now(), 1);
      ');
      $insert->execute(['email' => $email]);
      $open_order = $connect->prepare('
        SELECT order_id
        FROM orders
        WHERE open = 1 AND email = :email
        LIMIT 1;
      ');
      $open_order->execute(['email' => $email]);
      $open_order = $open_order->fetchColumn();
      
      $order_id = $open_order;
    }

    foreach($_POST['order'] as $id => $item) {
      if (is_array($open_order) && in_array($id, array_keys($open_order))) {
        $updatedAmount = (int) ($open_order[$id]['amount'] + $item['amount']);

        $update = $connect->prepare('
          UPDATE drinks_orders SET
          amount = :amount
          WHERE email = :email AND order_id = :order_id AND drink_id = :drink_id;
        ');
        $update->execute([
          'amount' => $updatedAmount,
          'email' => $email,
          'order_id' => $order_id,
          'drink_id' => $id
        ]);
      } else {
        $insert = $connect->prepare('
          INSERT INTO drinks_orders (drink_id, email, order_id, name, price, amount)
          VALUES (:drink_id, :email, :order_id, :name, :price, :amount);
        ');
        $insert->execute([
          'drink_id' => $id,
          'email' => $email,
          'order_id' => $order_id,
          'name' => $item['name'],
          'price' => $item['price'],
          'amount' => $item['amount']
        ]);
      }
    }
  }

  if(isset($_GET['order_finished']) && $open_order) {

    $update = $connect->prepare('
      UPDATE orders SET
      open = 0
      WHERE email = :email AND order_id = :order_id;
    ');
    $update->execute([
      'email' => $email,
      'order_id' => $order_id
    ]);

    header("Location: ../orders.php");
    die();
  } else {
    header("Location: ../index.php");
    die();
  }
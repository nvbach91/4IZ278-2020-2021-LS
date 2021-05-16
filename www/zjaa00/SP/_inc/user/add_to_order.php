<?php
  require_once "../config.php";
  
  $email = $_COOKIE['email'];

  $select = $connect->prepare('
    SELECT drinks_orders.drink_id, drinks_orders.order_id, amount
    FROM orders
    JOIN drinks_orders
        on drinks_orders.order_id = orders.order_id
    WHERE open = 1 AND drinks_orders.email = :email;
  ');
  $select->execute(['email' => $email]);
  $open_order = $select->fetchAll(PDO::FETCH_UNIQUE|PDO::FETCH_ASSOC);
  
  //odchytíme si ID objednávky od lubovoľného z drinkov
  @$order_id = $open_order[array_keys($open_order)[0]]['order_id'];

  //ak bolo stlačené tlačidlo "Zaplatené", tak s ním do tohoto skriptu príchádza aj
  //premenná $_GET['order_finished'], ktorá hlási, aby sme zmenili hodnotu atribútu
  //drinku open na 0 a presmerovali uživateľa na jeho objednávky - ak nemal nič objednané,
  //tak sa stránka znovu načíta (v JS je to ošetrené, tak, aby k tomuto nedošlo)
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

    header("Location: ../../orders.php");
    die();
  } elseif (isset($_GET['order_finished'])) {
    header("Location: ../../index.php");
    die();

  }

  //ak sme dostali AJAX request s nejakou objednávkou, tak ju pridáme do otvoreného účtu
  if (@$_POST['order']) {
    
    //ak sa chystáme otvoriť nový účet, tak si ho musíme najprv vytvoriť
    if(!$open_order) {
      $insert = $connect->prepare('
        INSERT INTO orders (email, created_at, open)
        VALUES (:email, now(), 1);
      ');
      $insert->execute(['email' => $email]);

      $order_id = $connect->lastInsertId();
    }

    foreach($_POST['order'] as $id => $item) {
      //ak už sme si nejaký drink objednali, tak len navýšime jeho množstvo - ak nie, tak ho pridáme do objednávky
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
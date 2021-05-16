<?php

  $select = $connect->prepare('
    SELECT SUM(price * amount) as total_sum
    FROM drinks_orders
    WHERE email = :email;
  ');
  $select->execute([
    'email' => $_COOKIE['email'],
  ]);
  $stat1 = $select->fetchColumn();
  
  $select = $connect->prepare('
    SELECT SUM(amount) as total_drinks
    FROM drinks_orders
    WHERE email = :email
    LIMIT 1;
  ');
  $select->execute([
    'email' => $_COOKIE['email'],
  ]);
  $stat2 = $select->fetchColumn();
  
  $select = $connect->prepare('
    SELECT COUNT(order_id) as total_orders
    FROM orders
    WHERE email = :email;
  ');
  $select->execute([
    'email' => $_COOKIE['email'],
  ]);
  $stat3 = $select->fetchColumn();

?>
  <div id="stats">
      <div>
        <h3><?= ceil($stat1) ?></h3>
        <p>eur</p>
      </div>
      <div>
        <h3><?= $stat2 ? $stat2 : "0" ?></h3>
        <p>drinkov</p>
      </div>
      <div>
        <h3><?= $stat3 ?></h3>
        <p>účty</p>
      </div>
  </div>
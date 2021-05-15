<?php

  $stat1 = $connect->prepare('
    SELECT SUM(price * amount) as total_sum
    FROM drinks_orders
    WHERE email = :email;
  ');
  $stat1->execute([
    'email' => $_COOKIE['email'],
  ]);
  $stat1 = $stat1->fetchColumn();
  
  $stat2 = $connect->prepare('
    SELECT SUM(amount) as total_drinks
    FROM drinks_orders
    WHERE email = :email
    LIMIT 1;
  ');
  $stat2->execute([
    'email' => $_COOKIE['email'],
  ]);
  $stat2 = $stat2->fetchColumn();
  
  $stat3 = $connect->prepare('
    SELECT COUNT(order_id) as total_orders
    FROM orders
    WHERE email = :email;
  ');
  $stat3->execute([
    'email' => $_COOKIE['email'],
  ]);
  $stat3 = $stat3->fetchColumn();

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
<?php
  require_once "../config.php";

  $select = $connect->prepare('
    SELECT orders.order_id as id, created_at, SUM(amount * price) as order_sum
    FROM orders
    JOIN drinks_orders
        on drinks_orders.order_id = orders.order_id
    WHERE orders.email = :email
    GROUP BY orders.order_id
    ORDER BY created_at desc
    LIMIT '.$_POST['limit'].' OFFSET '.$_POST['offset'].';
  ');
  $select->execute(['email' => $_COOKIE['email']]);
  $orders = $select->fetchAll();

  if ($orders): ?>
    <div>
      <?php foreach($orders as $order):?>

        <div class="order_card">
          <div class="content">
            <div class="head">
              <h3><?= date("M d, Y", strtotime($order['created_at'])) ?></h3>
              <h3><?= date("H:i", strtotime($order['created_at'])) ?></h3>
            </div>
            <div class="my_order">

            <?php
              $select = $connect->prepare('
                SELECT drinks_orders.name, drinks_orders.price, amount, (drinks_orders.price * amount) as drink_sum
                FROM orders
                JOIN drinks_orders
                    on drinks_orders.order_id = orders.order_id
                JOIN drinks
                    on drinks.drink_id = drinks_orders.drink_id
                WHERE orders.order_id = :id AND orders.email = :email
                ORDER BY amount desc;
              ');
              $select->execute([
                'email' => $_COOKIE['email'],
                'id' => $order['id']
              ]);
              $order_items = $select->fetchAll();
              foreach($order_items as $order_item):
            ?>
                <div class="order_item">
                  <p class="name"><?= $order_item['name'] ?></p>
                  <p class="amount"><?= (int) $order_item['amount'] ?></p>
                  <p>ks</p>
                  <p>*</p>
                  <p class="drink_price"><?= $order_item['price'] ?></p>
                  <p>=<span class="drink_sum"><?= $order_item['drink_sum'] ?></span></p>
                </div>

            <?php endforeach; ?>

            </div>
            <div class="overall">
              <p>CELKOM</p>
              <p><span id="sum"><?= $order['order_sum'] ?></span> EUR</p>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php else:
    die();
  endif; ?>
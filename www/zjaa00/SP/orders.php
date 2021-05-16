<?php
  require "./partials/header.php";
  require "./_inc/require_user.php";

  $email = $_COOKIE['email'];
?>
<body id="orders_page">
  <div>
    <h1>OBJEDNÁVKY</h1>
    <h3><?= $email ?></h3>
    
    <?php require "./partials/orders_page/orders_stats.php"; ?>

  </div>
  <div id="orders_box">
  <?php
    $select = $connect->prepare('
      SELECT open, orders.order_id as id, created_at, SUM(amount * price) as order_sum
      FROM orders
      JOIN drinks_orders
          on drinks_orders.order_id = orders.order_id
      WHERE orders.email = :email
      GROUP BY orders.order_id
      ORDER BY created_at desc
      LIMIT 10 OFFSET 0;
    ');
    $select->execute(['email' => $email]);
    $orders = $select->fetchAll();
    $total_row = $select->rowCount();
    if ($total_row):
      foreach($orders as $order):
  ?>

        <div class="order_card unselectable <?= $order['open'] ? "open" : "" ?>">
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
                'email' => $email,
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

<?php
      endforeach;
    else:
?>
  
      <h3>Žiadne objednávky</h3>

<?php
    endif;
?>

  </div>

<?php require "./partials/footer.php"; ?>
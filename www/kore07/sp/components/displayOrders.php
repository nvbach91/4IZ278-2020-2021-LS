<?php require_once __DIR__ . '/../database/ProductsDB.php'; ?>
<?php require_once __DIR__ . '/../database/UsersDB.php'; ?>
<?php require_once __DIR__ . '/../database/OrdersDB.php'; ?>
<?php
  if(!isset($_SESSION)){
    session_start();
  }

  $ordersDB = new OrdersDB();

  $ordersUsers = $ordersDB->fetchByUser($_SESSION['user_id']);

  if (!empty($ordersUsers)) {
    $_SESSION['products'] = [];
    $_SESSION['orders'] = [];
  
    $ordersID = [];
    $uniqueOrdersID = [];
    
    foreach($ordersUsers as $order) {
      array_push($ordersID, $order['order_id']);
    }
    
    array_push($uniqueOrdersID, $ordersID[0]);
    for ($i=1; $i<count($ordersID); $i++) {
      if ($ordersID[$i] !== $ordersID[$i-1]) {
        array_push($uniqueOrdersID, $ordersID[$i]);
      }
    }
  
    foreach($uniqueOrdersID as $uniqueID) {
      $_SESSION['products'][$uniqueID] = $ordersDB->fetchByOrder($_SESSION['user_id'], $uniqueID);
      $orders[] = $ordersDB->fetchOneByOrder($_SESSION['user_id'], $uniqueID);
    }
  }



?>

  <ul class="order-list">
    <?php if(empty($ordersUsers)) : ?>
      <p>There is no order yet </p>
    <?php else : ?>
      <?php foreach($orders as $order): ?>
      <li class="order-list_item">
        <h2>Order <?php echo ($order) ? $order['order_id'] : ''?></h2>
        <article class="order-list_item-block">
          <div class="order-description-wrapper">
            <h2 class="order-list_item-description">Products</h2>
            <?php foreach($_SESSION['products'][$order['order_id']] as $product): ?>
              <p class="order-list_item-personal order-list_item-personal--name">Product name: <?php echo ($product) ? $product['product_name'] : '' ?></p>
              <p class="order-list_item-personal order-list_item-personal--price">Amount: <?php echo ($product) ? $product['order_product_quantity'] : '' ?></p>
              <p class="order-list_item-personal order-list_item-personal--price">Price: <?php echo ($product) ? $product['product_price'] : '' ?></p>
              <?php endforeach; ?>
            </div>
          <div class="order-description-wrapper">
            <h2 class="order-list_item-description">Order data</h2>
            <p class="order-list_item-personal order-list_item-personal--name">Name: <?php echo ($order) ? $order['user_name'] : '' ?></p>
            <p class="order-list_item-personal order-list_item-personal--email">E-mail: <?php echo ($order) ? $order['user_email'] : '' ?></p>
            <p class="order-list_item-personal order-list_item-personal--address">Address: <?php echo ($order) ? $order['user_address'] . ', ' . $order['user_city'] . ', ' . $order['user_country'] . ',   ' . $order['user_zip'] : '' ?></p>
            <p class="order-list_item-personal order-list_item-personal--delivery">Delivery: <?php echo ($order) ? $order['order_delivery'] : '' ?></p>
            <p class="order-list_item-personal order-list_item-personal--payment">Payment: <?php echo ($order) ? $order['order_payment'] : '' ?></p>
            <p class="order-list_item-personal order-list_item-personal--total">Total: <?php echo ($order) ? number_format($order['order_total']) .  ' ' .  GLOBAL_CURRENCY : '' ?></p>
          </div>
        </article>
      </li>
      <?php endforeach; ?>
    <?php endif; ?>
  </ul>
</section>


<?php 
/*
// $_SESSION['products'][$uniqueID] = $ordersDB->fetchByOrder($_SESSION['user_id'], $uniqueID);
$order = $ordersDB->fetchOneByOrder($_SESSION['user_id'], $uniqueID);
$order['products'] = [];
$productIds = $orderProductsDb->fetchAllByOrderId($uniqueID);
[
  [
    productId => 5,
    quantity => 1
  ],
  [
    productId => 4,
    quantity => 1
  ],
  [
    productId => 2,
    quantity => 7
  ],
  [
    productId => 0,
    quantity => 6
  ]
]
foreach([1,5,4,3] as $orderItem) {
  $product = $productDB->fetchById($orderItem['productId'])
  $product['quantity'] = $orderItem['quantity']
  array_push($order['products'], $product);
}
$orders[] = $order;
*/

?>
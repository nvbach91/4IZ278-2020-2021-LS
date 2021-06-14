<?php 
  require("./config/config.php");


  if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
  }

  $cart = $_SESSION['cart'];
  $date = date("Y-m-d");

  $ids = $_SESSION['cart'];
  $totalAmount = 0;
  if (is_array($ids) && count($ids)) {
    $questionMarks = str_repeat("?, ", count($ids) - 1) . '?';

    $sql = "SELECT * FROM goods WHERE id IN(". $questionMarks .")";
    $statement = $connect->prepare($sql);
    $statement->execute(array_values($ids));

    $goods = $statement->fetchAll();
  }

  foreach ($goods as $good) {
      $totalAmount += $good['price'];
  }

  $stmt = $connect->prepare('INSERT INTO orders(user_email, created_at, total_amount) VALUES (:user_email, :created_at, :total_amount)');
  $stmt->execute([
      'user_email' => $_SESSION['user_email'], 
      'created_at' => $date,
      'total_amount' =>$totalAmount
  ]);

  $order_id = $connect->lastInsertId();

  foreach ($cart as $item_id){
    $stmt = $connect->prepare('INSERT INTO products_orders(order_id, product_id) VALUES (:order_id, :product_id)');
    $stmt->execute([
        'order_id' => $order_id, 
        'product_id' => $item_id
    ]);
  }

  unset($_SESSION['cart']);
  require("./partials/header.php");
  require("./navigation.php");
?>

<div class="container mt-5 mb-5">
    <div class="row d-flex justify-content-center">
        <div class="col-md-8">
            <div class="card">
                
                <div class="invoice p-5">
                    <h5>Your order Confirmed!</h5> <span class="font-weight-bold d-block mt-4">Hello, <?= $_SESSION['user_email']?></span> <span>You order has been confirmed and will be shipped in next two days!</span>
                    <div class="payment border-top mt-3 mb-3 border-bottom table-responsive">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="py-2"> <span class="d-block text-muted">Order Date</span> <span><?= $date ?></span> </div>
                                    </td>
                                    <td>
                                        <div class="py-2"> <span class="d-block text-muted">Order No</span> <span><?= $order_id ?></span> </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="product border-bottom table-responsive">
                        <table class="table table-borderless">
                            <tbody>
                              <?php foreach ($goods as $good) :?>
                                <tr>
                                    <td width="20%"> <img src="<?= isset($good['img']) ? $good['img'] : './img/img.jpg' ?>" width="90"> </td>
                                    <td width="60%"> <span class="font-weight-bold">Name: <?= $good['name']; ?></span>
                                        <div class="product-qty"> <span class="d-block">Description: <?= $good['description']; ?></span> <span>Color:Dark</span> </div>
                                    </td>
                                    <td width="20%">
                                        <div class="text-right"> <span class="font-weight-bold"><?= $good['price']; echo $currency; ?></span> </div>
                                    </td>
                                </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                    <div class="row d-flex justify-content-end">
                        <div class="col-md-5">
                            <table class="table table-borderless">
                                <tbody class="totals">
                                    <tr class="border-top border-bottom">
                                        <td>
                                            <div class="text-left"> <span class="font-weight-bold">Total</span> </div>
                                        </td>
                                        <td>
                                            <div class="text-right"> <span class="font-weight-bold"><?= $totalAmount; echo $currency?></span> </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <p>We will be sending shipping confirmation email when the item shipped successfully!</p>
                    <p class="font-weight-bold mb-0">Thanks for shopping with us!</p> <span>NBA vintage Team</span>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require("./partials/footer.php"); ?>

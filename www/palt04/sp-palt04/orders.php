<?php 
      require("./config/config.php");

      if (!isset($_SESSION['user_email'])) {
        header('Location: login.php');
      }
    $i = 0;
    $stmt = $connect->prepare('SELECT * FROM orders WHERE user_email = :user_email ORDER BY created_at DESC');
    $stmt->execute([
        'user_email' => $_SESSION['user_email']
    ]);

    $orders = $stmt->fetchAll();
    require("./partials/header.php");
    require("./navigation.php");
?>

<div class="container mt-5">
    <div class="d-flex justify-content-center row">
        <div class="col-md-10">
            <div class="rounded">
            <?php if ($orders): ?>
                <div class="table-responsive table-borderless">
                    <table class="table">
                        <thead class="">
                            <tr>
                                <th class="text-center">#</th>
                                <th>Order #</th>
                                <th>Total</th>
                                <th>Created</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody class="table-body">
                        <?php foreach ($orders as $order) : $i+=1?>
                            <tr class="cell-1">
                                <td class="text-center"><?= $i ?></td>
                                <td>#<?= $order['id']; ?></td>
                                <td><?= $order['total_amount']; echo $currency?></td>
                                <td><?= $order['created_at']; ?></td>
                                <td><a href="order-detail.php?id=<?= $order['id']; ?>"><img src="./resources/img/search.png"></a></td>
                            </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            <?php  else: ?>
                <div style="padding: 25px; background: #efefef; color: firebrick; border-radius: 10px;"> You have no orders </div>
            <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php require("./partials/footer.php"); ?>
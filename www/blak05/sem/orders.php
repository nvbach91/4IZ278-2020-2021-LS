<?php
    session_start();
    $_SESSION["location"] = "orders";
    $username = $_SESSION["user"];
    require __DIR__ . '/db/usersDB.php';
    $usersDB = new UsersDB();
    $user = $usersDB->fetch($username);
    require __DIR__ . '/db/orderDB.php';
    require __DIR__ . '/db/orderproductDB.php';

    if (!empty($_GET)) {
        $offset = $_GET['offset'];
    } else {
        $offset = 0;
    }
    $numberOfOrdersPerPagination = 2;
    $ordersDB = new OrderDB();
    $numberOfOrders = $ordersDB->fetchCount($user["ID_User"]);

    $ordersDB = new OrderDB();
    $ordersCount = $ordersDB->fetchOffset([$user["ID_User"],$numberOfOrdersPerPagination,$offset]);

    $numberPaginations = ceil($numberOfOrders / $numberOfOrdersPerPagination);

?>
<?php require __DIR__ . '/incl/header.php'; ?>
<?php require __DIR__ . '/incl/navbar.php'; ?>

<main>
    <div class="container text-center onas">
        <h1>Objednávky <?php echo $user["name"]?></h1>
        <br>
        <?php if(empty($ordersCount)): ?>
            <p>Zatím nebyla provedena žádná objednávka</p>
        <?php else: ?>
            <?php foreach($ordersCount as $order): ?>
                <div style="border: 1px solid black; max-width: 600px; margin: 0 auto; padding: 10px">
                    <h4>Objednávka č. <?php echo $order['id_order']?></h4>
                    <p> zadáno <b><?php echo $order['date']?></b>, celková částka <b><?php echo $order['total_price']?> Kč</b><br>
                    vybrána doprava <b><?php echo $order['doprava']?></b> a platba <b><?php echo $order['platba']?></b></p> 
                    <h5 class="text-start">Objednáno:<h5>
                    <?php $ordersProductsDB = new OrderProductDB();
                    $orderedproducts = $ordersProductsDB->fetchProduct($order['id_order']); ?>
                    <div style="max-width: 450px">
                    <ol>
                    <?php foreach($orderedproducts as $product): ?>
                        <li class="text-start"><?php echo $product["brand"] . " - " .$product["name"] . " - " .$product["price"] . " Kč"?></li>
                    <?php endforeach ?>
                    </ol>
                    </div>
                </div>
                <br>
            <?php endforeach ?>
        <?php endif ?>                 
        <nav>
            <ul class="pagination justify-content-center">
            <?php for ($i = 1; $i <= $numberPaginations; $i++) { ?>
                <li class="page-item">
                    <a class="text-warning page-link <?php echo $offset / $numberOfOrdersPerPagination + 1 == $i ? ' active' : ''; ?>" href="orders.php?offset=<?php echo $numberOfOrdersPerPagination * ($i - 1); ?>">
                        <?php echo $i; ?>
                    </a>
                </li>
            <?php } ?>
        </ul>
        </nav>
    </div> 
</main>
<?php require __DIR__ . '/incl/footer.php'; ?>
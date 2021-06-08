<?php
    session_start();
    $_SESSION["location"] = "order";
?>
<?php require __DIR__ . '/incl/header.php'; ?>
<?php require __DIR__ . '/incl/navbar.php'; ?>
<?php require __DIR__ . '/db/usersDB.php' ?>
<?php require __DIR__ . '/db/beersDB.php'; ?>
<?php require __DIR__ . '/db/shippingDB.php'; ?>
<?php require __DIR__ . '/db/paymentsDB.php'; ?>
<?php
    $_SESSION["price"] = 0;
    $userid = $_SESSION["user"];
    $usersDB = new UsersDB();
    $user = $usersDB->fetch($userid);
    $productsDB = new BeersDB();
    $products = $productsDB->fetchCart();
    $shippingDB = new ShippingDB();
    $shippings = $shippingDB->fetchAll();
    $paymentsDB = new PaymentsDB();
    $payments = $paymentsDB->fetchAll();
?>

<main>
<div class="container text-center onas">
    <h1>Dokončení objednávky</h1>
    <br>
        <!-- část objednávající-->
        <div class="pt-2" style="max-width: 450px; margin: 0 auto; border: 1px solid black;">
            <h4 class="text-decoration-underline">Osobní údaje</h4>
            <p>
                <?php echo $user["name"] ?><br> <?php echo $user["address"]. " " .$user["city"].", " .$user["psc"]  ?><br>
                <?php echo $user["email"] ?> <br>
                <div class="text-muted">něco je špatně? upravte osobní údaje <a class="text-decoration-none text-dark" href="settings.php">zde</a></div>
            </p>
        </div>
        <br>
        <!-- část objednané-->
        <div class="pt-2" style="max-width: 450px; margin: 0 auto; border: 1px solid black;">
            <h4 class="text-decoration-underline">Objednané produkty</h4>
            <p>
            <?php foreach($products as $product): ?>
                <?php $_SESSION["price"] = $_SESSION["price"] + $product['price']?>
                <?php echo $product['brand']. " ". $product['name'] . " - ". $product['price'] ." Kč" ?><br>
            <?php endforeach ?>
            <h4>Celková cena <?php echo $_SESSION["price"] ?>,-</h4>
            <div class="text-muted">něco je špatně? upravte produkty <a class="text-decoration-none text-dark" href="cart.php">zde</a></div>
            </p>
        </div>
        <br>
    <form action="placeorder.php" method="POST">
        <!-- část doprava-->
        <div class="pt-2" style="max-width: 450px; margin: 0 auto; border: 1px solid black;">
            <h4 class="text-decoration-underline">Volba dopravy</h4>
            <div class="pb-3" style="max-width: 200px; margin: 0 auto;">
            <?php foreach($shippings as $shipping): ?>
                <div class="form-check text-start">
                    <input class="form-check-input" type="radio" name="id_shipping" value="<?php echo $shipping['id_shipping']?>"checked>
                    <label class="form-check-label" for="id_shipping"><?php echo $shipping['name']. " - ".$shipping['price']. " Kč" ?></label>
                </div>
            <?php endforeach ?>
            </div>
        </div>
        <br>
        <!-- část platba-->
        <div class="pt-2" style="max-width: 450px; margin: 0 auto; border: 1px solid black;">
            <h4 class="text-decoration-underline">Volba platby</h4>
            <div class="pb-3" style="max-width: 250px; margin: 0 auto;">
            <?php foreach($payments as $payment): ?>
                <div class="form-check text-start">
                    <input class="form-check-input" type="radio" name="id_payment" value="<?php echo $payment['id_payment']?>" checked>
                    <label class="form-check-label" for="id_payment"><?php echo $payment['name']. " - ".$payment['price']. " Kč" ?></label>
                </div>
            <?php endforeach ?>
            </div>
        </div>
        <br>
        <button class="btn btn-warning btn-block" type="submit">Odeslat objednávku</button>
    </form>
</div>
</main>
<?php require __DIR__ . '/incl/footer.php'; ?>
<?php
    session_start();
    $_SESSION["location"] = "cart";
?>
<?php require __DIR__ . '/incl/header.php'; ?>
<?php require __DIR__ . '/incl/navbar.php'; ?>
<?php require __DIR__ . '/db/beersDB.php'; ?>
<?php
    if(!isset($_SESSION['cart'])){
        $_SESSION['cart'] = [];
    }
?>
<main>
    <div class="container text-center onas">
        <h1>Nákupní košík</h1>
        <br>
        <?php if(isset($_SESSION['cart']) && (count($_SESSION['cart']) >= 1)): ?>
            <div style="max-width: 600px; margin: 0 auto;">
            <?php
                $iterated = [];
                $cartProducts = $_SESSION['cart'];
                $finalPrice = 0;
            ?>
            <?php foreach($cartProducts as $product): ?>
                <?php 
                    $counter = count(array_keys($cartProducts, $product));
                    $productsDB = new BeersDB(); 
                    $celyProduct = $productsDB->fetchBeerID($product); 
                ?>
                <?php if(($counter == 1) || (count(array_keys($iterated, $product))==0)):?>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold"><?php echo $celyProduct['brand']?> - <?php echo $celyProduct['name']?> - <?php echo $counter?> kusů</div>
                        </div>
                        <a href="remove-item.php?id=<?php echo $celyProduct['id_product']?>">
                            <span class="badge bg-danger rounded-pill">X</span>
                        </a>
                    </li>
                    <?php $finalPrice = $finalPrice + $counter * $celyProduct["price"]?>
                    <?php array_push($iterated,$product); ?>
                <?php endif ?>
            <?php endforeach; ?>
            <br>
                <h3>Celková cena je <?php echo $finalPrice ?> Kč </h3>
            <br>
            <a href="neworder.php"><button type="button" class="btn btn-warning">Dokončit objednávku</button></a>
            </div>
        <?php elseif(isset($_SESSION['user'])): ?>
            <p class="pb-5">Váš nákupní košík je prázdný!</p>
        <?php else: ?>
            <h4 class="pb-5">Pro nákup se musíte přihlásit!</h4>
        <?php endif ?>
    </div>
</main>
<?php require __DIR__ . '/incl/footer.php'; ?>
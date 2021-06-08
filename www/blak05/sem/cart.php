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

    if(count($_SESSION['cart']) >= 1){
        $idproduktu = $_SESSION['cart'];

        $productsDB = new BeersDB();
        $products = $productsDB->fetchCart();
        foreach($products as $product){
            echo $product['name'];
        };
    }

?>
<main>
    <div class="container text-center onas">
        <h1>Nákupní košík</h1>
        <br>
        <?php if(isset($_SESSION['cart']) && (count($_SESSION['cart']) >= 1)): ?>
            <div style="max-width: 600px; margin: 0 auto;">
            <?php foreach($products as $product): ?>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <div class="fw-bold"><?php echo $product['brand']?> - <?php echo $product['name']?> (<?php echo $product['price']?> Kč)</div>
                    </div>
                    <a href="remove-item.php?id=<?php echo $product['id_product']?>">
                        <span class="badge bg-danger rounded-pill">X</span>
                    </a>
                </li>
            <?php endforeach; ?>
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
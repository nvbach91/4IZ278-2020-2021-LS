<?php require_once __DIR__ . '/class/CartDB.php'; ?>
<?php

$cartDB = new CartDB();
$products= $cartDB->fetchAll();
$sum = $cartDB->getSumOfProducts();


?>


<?php include __DIR__ . '/includes/header.php' ?>
<?php require __DIR__ . '/includes/navigation.php'; ?>  
<body>
    <div class="container">

    <h1 style="margin-top:20px;">My shopping cart</h1>
    Total products selected:
     <?php if(empty($products)) {echo "0";}
    else {echo count($products);};
    ?>
    <br><br>
    <a class="btn btn-secondary" href="index.php">Back to the shop</a>
    <br><br>
    <h3 style="margin-bottom:10px">Celkem: <?php echo round($sum,2); ?> Kč</h3>




    <?php if(@$products): ?>
    <div class="products">
    <div class="row">
        <?php foreach($products as $product): ?>
            
        <div class="card" style="width:320px; margin:20px;">

        <img class="class-img-top" src="<?php echo $product['img']; ?>" width="200" height="160" alt="img"></img>
            <div class="card-body">
                <h5 class="card-title"><?php echo $product['name'] ?></h5>
                <div class="card-subtitle"><?php echo $product['price'] ?> Kč</div>
                <form action="remove-item.php" method="POST">
                    <input class="d-none" name="id" value="<?php echo $product['product_id'] ?>">
                    <button type="submit" class="btn btn-danger">Remove</button>
                </form>
            </div>
        </div>
        
        <?php endforeach; ?>
        </div>
    </div>
    <?php else: ?>
    <h5>No products</h5>
    <?php endif; ?>
    </div>

    <?php include __DIR__ . '/includes/footer.php' ?>
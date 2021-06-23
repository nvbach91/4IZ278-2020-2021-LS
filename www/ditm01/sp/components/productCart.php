<?php foreach ($products as $product) : ?>
    <div class="col">
        <div class="card">
            <img src="<?php echo $product['image']; ?>" class="card-img-top" alt="<?php echo $product['name']; ?>">
            <div class="card-body">
                <h5 class="card-title"><?php echo $product['name']; ?></h5>
                <p class="card-text"><?php echo $product['description']; ?></p>
                <h6><?php echo $product['price'] . ' ' . CURRENCY; ?></h6>
                <a href="buy.php?id=<?php echo $product['id']; ?>" class="btn btn-primary">Buy</a>
            </div>
        </div>
    </div>
<?php endforeach; ?>
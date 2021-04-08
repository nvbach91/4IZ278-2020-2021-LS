<?php /** @var array $product */ ?>

<div class="col-sm-12 col-md-6 col-lg-3">
    <div class="card mb-5">
        <div class="wrapper">
            <img class="card-img-top" alt="<?= $product["name"] ?>" src="<?= $product["image_url"] ?>">
        </div>
        <div class="card-body">
            <h5 class="card-title"><?= $product["name"] ?></h5>
            <h2 class="text-muted"><?= $product["price"] ?> CZK</h2>
        </div>
    </div>
</div>
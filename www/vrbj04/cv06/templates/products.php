<?php /** @var array $products */ ?>

<h1>Produkty</h1>
<div class="row mt-3">
    <?php foreach ($products as $product): ?>
        <?php require __DIR__ . "/product.php"; ?>
    <?php endforeach; ?>
</div>

<style>
    .wrapper {
        position: relative;
        overflow: hidden;
    }

    .wrapper:after {
        content: '';
        display: block;
        padding-top: 100%;
    }

    .wrapper img {
        width: auto;
        height: 100%;
        max-width: none;
        position: absolute;
        left: 50%;
        top: 0;
        transform: translateX(-50%);
    }
</style>
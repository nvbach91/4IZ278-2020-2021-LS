<?php
require "incl/header.php";
require "incl/navbar.php";
?>
<?php

$products = [
    ['name' => 'Intel Core i7-9700KF', 'price' => 49.9, 'img' => 'https://cdn.alza.cz/ImgW.ashx?fd=f16&cd=BO533e7a'],
    ['name' => 'Intel Core i9-10900X', 'price' => 60.9, 'img' => 'https://cdn.alza.cz/ImgW.ashx?fd=f16&cd=BO535x2c'],
    ['name' => 'AMD Ryzen 9 3950X', 'price' => 47.9, 'img' => 'https://cdn.alza.cz/ImgW.ashx?fd=f16&cd=BD750j3'],
];

?>
<main class="container">
    <H1>Cart</H1>
    <div>
        <?php foreach($products as $product): ?>
            <div class="card mb-3" style="min-width: 500px;">
                <div class="row g-">
                    <div class="col align-self-center">
                        <img style="width: 50px" src="<?php echo $product['img'] ?>" alt="...">
                    </div>
                    <div class="col align-self-center">
                        <h5 class="card-title"><?php echo $product['name'] ?></h5>
                    </div>
                    <div class="col align-self-center">
                        <button type="button" class="btn btn-danger">Remove</button>
                    </div>
                    <div class="col align-self-center">
                        <h5 class="card-title">$<?php echo $product['price'] ?></h5>
                    </div>

                </div>

            </div>
        <?php endforeach; ?>
    </div>
    <h3 style="text-align: right; margin-right: 100px">Total: $$$</h3>
    <div class="d-grid gap-2">
        <button class="btn btn-primary" type="button" style="font-size:  2rem;">Send order</button>

    </div>
</main>
<?php
require  "incl/footer.php";
?>



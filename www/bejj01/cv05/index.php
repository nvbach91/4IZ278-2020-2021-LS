<?php include __DIR__ . '/includes/header.php'?>

<main class="container col-md-10">
    <br>
    <div class="row justify-content-center">
        <h1 class="text-center">Fake Database</h1>
    </div>
    <p class="border border-white p-4 text-center">
        <?php include __DIR__ . '/classes/users.php'?>
    </p>
    <hr class="bg-white">
    <p class="border border-white p-4 text-center">
        <?php include __DIR__ . '/classes/products.php'?>
    </p> 
    <hr class="bg-white"> 
    <p class="border border-white p-4 text-center">
        <?php include __DIR__ . '/classes/orders.php'?> 
    </p> 
</main>

<?php include __DIR__ . '/includes/footer.php'?> 

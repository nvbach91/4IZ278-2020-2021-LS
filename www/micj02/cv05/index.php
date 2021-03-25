<?php include 'include/header.php' ?>
<?php include 'include/database.php' ?>
<main>
    <div class="row m-3"><h1>Database</h1></div>
    <div class="row m-3">
        <pre>
         <?php
         echo PHP_EOL;
         $users = new UsersDB();
         $users->configInfo();
         echo PHP_EOL;
         $users->create(['id' => 1, 'name' => 'Dave', 'email' => 'dave@mail.com']);
         $users->fetch(1);
         $users->save(['id' => 1, 'name' => 'Dave', 'email' => 'cool.dave@mail.com']);
         $users->delete(1);
         echo PHP_EOL;

         $products = new ProductsDB();
         $products->configInfo();
         echo PHP_EOL;
         $products->create(['id' => 1, 'name' => 'Broom of Harry', 'price' => 4500]);
         $products->fetch(1);
         $products->save(['id' => 1, 'name' => 'Broom of Harry', 'price' => 9900]);
         $products->delete(1);
         echo PHP_EOL;

         $orders = new OrdersDB();
         echo $orders, PHP_EOL;
         $orders->create(['id' => 1, 'date' => '2019-03-08', 'note' => '']);
         $orders->fetch(1);
         $orders->save(['id' => 1, 'date' => '2019-03-08', 'note' => 'Very nice.']);
         $orders->delete(1);
         ?>
            </pre>
    </div>
</main>
<?php include 'include/footer.php' ?>

<?php include __DIR__ . '/includes/header.php' ?>
<?php include __DIR__ . '/includes/navigation.php' ?>
<div class="container">
    <h1 class="row justify-content-center">Welcome</h1>
    <div class="row justify-content-center">
     
            <p style="text-align:center;">Here is the information from the database: </p>

  
            <pre>


            <?php

            require "Database.php";
            require "UsersDB.php";
            require "User.php";
            require "ProductsDB.php";
            require "Product.php";
            require "OrdersDB.php";
            require "Order.php";


            $users = new UsersDB();
            $users->getConfig();
            $users->create(new User(1, "Luke Brown", 21));
            $users->create(new User(2, "Tom Hash", 45));
            $users->create(new User(3, "John Mayer", 45));
            $users->fetch();
            $users->save();
            $users->delete();
            echo PHP_EOL;

            $products = new ProductsDB();
            $users->getConfig();
            $products->create(new Product(1928, "Audi A8", 678000));
            $products->create(new Product(2221, "BMW X5", 999900));
            $products->create(new Product(3432, "Skoda Octavia", 499900));
            $products->create(new Product(4920, "Tatra ZS2", 3999900));
            echo PHP_EOL;

            $orders = new OrdersDB();
            $users->getConfig();
            echo PHP_EOL;
            echo $orders, PHP_EOL;
            $orders->create(new Order(1, 1, [1928, 2221]));
            echo $orders, PHP_EOL;


            ?>
            </pre>
        </div>
    </div>
</div>

<?php include __DIR__ . '/includes/footer.php' ?>
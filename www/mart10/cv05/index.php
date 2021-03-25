<?php
spl_autoload_register( function ($class_name) {
    $CLASSES_DIR = __DIR__ . DIRECTORY_SEPARATOR . 'model' . DIRECTORY_SEPARATOR;
    $file = $CLASSES_DIR . $class_name . '.php';
    if( file_exists( $file ) ) include $file;  
} );
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Database</title>
</head>

<body>
    <pre>
        <?php
        $users = new UsersDB();
        $users->configInfo();
        $users->delete(['id' => '120']);

        $users->create(['id' => '1', 'name' => 'Luffy', 'age' => '20']);
        $users->create(['id' => '2', 'name' => 'Zoro', 'age' => '25']);
        $users->fetch(['id' => '1']);

        $users->create(['id' => '2', 'name' => 'Roronoa Zoro', 'age' => '25']);
        $users->save(['id' => '2', 'name' => 'Roronoa Zoro', 'age' => '26']);
        $users->fetch(['id' => '2']);

        $users->delete(['id' => '1']);
        $users->fetch(['id' => '1']);


        $products = new ProductsDB();
        $products->delete(['id' => '2']);

        $products->create(['id' => '1', 'name' => 'vodka', 'price' => '100']);
        $products->create(['id' => '2', 'name' => 'rum', 'price' => '250']);
        $products->fetch(['id' => '1']);

        $products->create(['id' => '2', 'name' => 'wine', 'price' => '120']);
        $products->save(['id' => '2', 'name' => 'wine', 'price' => '130']);
        $products->fetch(['id' => '2']);


        $products->delete(['id' => '1']);
        $products->fetch(['id' => '1']);


        $orders = new OrdersDB();
        $orders->delete(['id' => '2']);

        $orders->create(['id' => '1', 'date' => '2021-01-01']);
        $orders->create(['id' => '2', 'date' => '2021-02-01']);
        $orders->fetch(['id' => '1']);

        $orders->create(['id' => '2', 'date' => '2021-03-01']);
        $orders->save(['id' => '2', 'date' => '2021-03-02']);
        $orders->fetch(['id' => '2']);

        $orders->delete(['id' => '1']);
        $orders->fetch(['id' => '1']);
        ?>
    </pre>
</body>

</html> 
<?php require_once './model.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Database</title>
</head>

<body>
    <?php
    // Vytvoreni objektu tridy UsersDB a vymazani dosavadnich zaznamu
    $users = new UsersDB();
    $users->delete(['id' => '2']);

    // Novy zaznam
    $users->create(['id' => '1', 'name' => 'Dave', 'age' => '42']);
    $users->create(['id' => '2', 'name' => 'Jane', 'age' => '11']);

    // Kontrola pridani
    $users->fetch(['id' => '1']);

    // Pokus o pridani id=2 znovu
    $users->create(['id' => '2', 'name' => 'Jane', 'age' => '11']);

    // Update zaznamu id = 2
    $users->save(['id' => '2', 'name' => 'Joey', 'age' => '12']);

    // Kontrola zmeny
    $users->fetch(['id' => '2']);

    // Smazani zaznamu id=1
    $users->delete(['id' => '1']);

    // Kontrola zmeny
    $users->fetch(['id' => '1']);





    // Vytvoreni objektu tridy ProductsDB a vymazani dosavadnich zaznamu
    $products = new ProductsDB();
    $products->delete(['id' => '2']);

    // Novy zaznam
    $products->create(['id' => '1', 'name' => 'car', 'price' => '1 000 000 ']);
    $products->create(['id' => '2', 'name' => 'chair', 'price' => '2999']);

    // Kontrola pridani
    $products->fetch(['id' => '1']);

    // Pokus o pridani id=2 znovu
    $products->create(['id' => '2', 'name' => 'table', 'price' => '8999']);

    // Update zaznamu id = 2
    $products->save(['id' => '2', 'name' => 'table', 'price' => '8999']);

    // Kontrola zmeny
    $products->fetch(['id' => '2']);

    // Smazani zaznamu id=1
    $products->delete(['id' => '1']);

    // Kontrola zmeny
    $products->fetch(['id' => '1']);





    // Vytvoreni objektu tridy OrdersDB a vymazani dosavadnich zaznamu
    $orders = new OrdersDB();
    $orders->delete(['id' => '2']);

    // Novy zaznam
    $orders->create(['id' => '1', 'date' => '2021-04-25']);
    $orders->create(['id' => '2', 'date' => '2021-09-17']);

    // Kontrola pridani
    $orders->fetch(['id' => '1']);

    // Pokus o pridani id=2 znovu
    $orders->create(['id' => '2', 'date' => '2021-09-17']);

    // Update zaznamu id = 2
    $orders->save(['id' => '2', 'date' => '2022-09-17']);

    // Kontrola zmeny
    $orders->fetch(['id' => '2']);

    // Smazani zaznamu id=1
    $orders->delete(['id' => '1']);

    // Kontrola zmeny
    $orders->fetch(['id' => '1']);
    ?>
</body>

</html>
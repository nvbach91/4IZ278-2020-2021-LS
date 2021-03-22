<?php include './includes/header.php'; ?>
<?php include __DIR__ . '/database.php'; ?>
<main class="container">
    <?php
    $orders = new OrdersDB();

    $orders->create(['id' => '1', 'item' => 'Floor']);
    $orders->create(['id' => '2', 'item' => 'Wall']);

    $orders->fetch();

    $orders->create(['id' => '2', 'item' => 'Window']);

    $orders->save(['id' => '2', 'item' => 'Toilet']);

    $orders->fetch();

    $orders->delete(['id' => '1']);

    $orders->fetch();

    ?>
    <br>
    <br>
    <?php
    $products = new ProductsDB();

    $products->create(['id' => '1', 'name' => 'Table', 'price' => '5000']);
    $products->create(['id' => '2', 'name' => 'Chair', 'price' => '700']);

    $products->fetch();

    $products->create(['id' => '2', 'name' => 'Table', 'price' => '8999']);

    $products->save(['id' => '2', 'name' => 'Table', 'price' => '6000']);

    $products->fetch();

    $products->delete(['id' => '1']);

    $products->fetch();
    ?>
    <br>
    <br>
    <?php
    $users = new UsersDB();

    $users->create(['id' => '1', 'name' => 'Michael', 'age' => '21']);
    $users->create(['id' => '2', 'name' => 'Tomáš', 'age' => '22']);

    $users->fetch();

    $users->create(['id' => '2', 'name' => 'Michael', 'age' => '22']);

    $users->save(['id' => '2', 'name' => 'Michael', 'age' => '28']);

    $users->fetch();

    $users->delete(['id' => '1']);

    $users->fetch();
    ?>
</main>
<?php include './includes/footer.php'; ?>
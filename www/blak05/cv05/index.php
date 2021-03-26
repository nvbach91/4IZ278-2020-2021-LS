<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database</title>
    <style>
        h1{text-align: center;}
        div{border: 1px solid black; margin: 0 auto; padding: 0 5px; max-width: 490px;}
        p{text-align: center;}
    </style>
</head>
<body>
    <h1>Databáze</h1>
    <?php require('logic.php') ?>
    <div>
        <p class="users">
            <?php
                $fb = new UsersDB();
                $fb->fetch('eduard@vse.cz'); // zkusíme najít neexistujícího uživatele
                $fb->create(['name' => 'Eda', 'mail' => 'eduard@vse.cz', 'age' => 51]); // přidáme ho
                $fb->fetch('eduard@vse.cz'); // najdeme ho
                $fb->save(['name' => 'Eda', 'mail' => 'eduard@vse.cz', 'age' => 21]); //změníme ho
                $fb->delete('eduard@vse.cz'); // odstraníme ho
                $fb->fetch('eduard@vse.cz'); // nenajdeme ho
            ?>
        </p>
        <p class="products">
            <?php
                $shop = new ProductsDB();
                $shop->fetch('3'); // zkusíme najít neexistující produkt
                $shop->create(['id' => 3, 'name' => 'iMac', 'price' => 400]); // přidáme ho
                $shop->fetch('3'); // najdeme ho
                $shop->save(['id' => 3, 'name' => 'iMac Pro', 'price' => 4000]); //změníme ho
                $shop->delete(3); // odstraníme ho
                $shop->fetch(3); // nenajdeme ho
            ?>
        </p>

        <p class="orders">
            <?php
                $pizza = new OrdersDB();
                $pizza->fetch('3'); // zkusíme najít neexistující objednávku
                $pizza->create(['id' => 3, 'name' => 'Hawaii', 'date' => '31-1-2021']); // přidáme ji
                $pizza->fetch('3'); // najdeme ji
                $pizza->save(['id' => 3, 'name' => 'Hot Spicy', 'date' => '1-1-2020']); //změníme ji
                $pizza->delete(3); // odstraníme ji
                $pizza->fetch(3); // nenajdeme ji
            ?>
        </p>
    </div>
    
</body>
</html>

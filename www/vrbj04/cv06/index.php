<?php

use cv06\database\EshopDatabase;

require __DIR__ . "/autoloader.php";

$connection = new PDO("mysql:host=localhost;port=3306;dbname=weby;user=weby;password=password");

EshopDatabase::connect($connection);


if (isset($_GET["initDB"])) {
    /** @noinspection SqlWithoutWhere */
    $query = <<<SQL
DELETE FROM `categories`;
INSERT INTO `categories`
    (`category_id`, `number`, `name`) VALUES
    (1, 1, 'Řezané květiny'),
    (2, 2, 'Míchané květiny'),
    (3, 3, 'Pokojové rostliny'),
    (4, 4, 'Doplňky');

DELETE FROM `products`;
INSERT INTO `products`
    (`category_id`, `name`, `price`, `image_url`) VALUES
    (1, 'Růže', 50, 'https://rosebelle.cz/wp-content/uploads/roza_dluga_mg_3816-1292x800.jpg'),
    (1, 'Chryzantéma', 80, 'https://upload.wikimedia.org/wikipedia/commons/c/c3/Beautiful_Chrysanthemum.JPG'),
    (1, 'Gerbera', 30, 'https://prima-receptar.cz/wp-content/uploads/2020/05/pokojove-gerbery.jpg'),
    (2, 'Růžová kytice 20 květů', 150, 'https://fiorita.cz/wp-content/uploads/2020/06/romanticka-ruzova-kytice-romantic-pink-bouquet-romantichnyj-rozovyj-buket-1.jpeg'),
    (2, 'Červená kytice 25 květů', 180, 'https://www.svatbona.cz/wp-content/gallery/cervena-svatebni-kytice/cervena-svatebni-kytice-5.jpg'),
    (2, 'Žlutá kytice 50 květů', 400, 'https://www.kvetinyiris.cz/fotky22625/fotos/_vyr_141_o6.jpg'),
    (3, 'Aloe vera', 350, 'https://i00.eu/img/479/1200x630/7lxu9z8j/10904.jpg'),
    (3, 'Opuncia', 195, 'https://cdn.myshoptet.com/usr/www.gardners-eshop.cz/user/shop/big/3825-6_gardners-cz-opuncia--nahledove-foto-3.jpg?5ffdb814'),
    (3, 'Sanseveria', 300, 'https://asset.bloomnation.com/c_pad,d_vendor:global:catalog:product:image.png,f_auto,fl_preserve_transparency,q_auto/v1605461805/vendor/3914/catalog/product/2/0/20200531013559_file_5ed3b2bf9a008_5ed3b4319cb16.jpg'),
    (4, 'Hlína 20L', 80, 'https://static.wikia.nocookie.net/minecraft_gamepedia/images/2/2d/Plains_Grass_Block.png'),
    (4, 'Květináč 15cm', 50 , 'https://cdn.hornbach.cz/data/shop/D04/001/780/491/333/827/DV_8_3154787_01_4c_DE_20190205161659.jpg'),
    (4, 'Květináč 20cm', 80 , 'https://cdn.hornbach.cz/data/shop/D04/001/780/491/333/827/DV_8_3154787_01_4c_DE_20190205161659.jpg'),
    (4, 'Váza 15L', 300, 'https://www.ikea.com/cz/cs/images/products/gradvis-vaza-ruzova__0524970_pe644685_s5.jpg');
    
DELETE FROM `slides`;
INSERT INTO `slides`
    (`name`, `image_url`) VALUES
    ('15 růží za cenu 10!', 'https://www.magazinzahrada.cz/wp-content/uploads/2019/02/shutterstock_699639550-1100x618.jpg'),
    ('Doprava zdarma při nákupu nad 200kč!', 'https://img.protext.cz/1518079922_Gebrueder_Weiss_Transport.jpg')
SQL;

    $connection->exec($query);
}


require __DIR__ . "/templates/index.php";

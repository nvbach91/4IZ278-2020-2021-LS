<?php
    require __DIR__ . '/../database/productsDB.php';

    $productsDB = new ProductsDB();

    /*$products = [
        ['name' => 'Pán Prstenů: Společenstvo Prstenu', 'img' => 'https://prodimage.images-bn.com/pimages/9780358380238_p0_v2_s550x406.jpg','price' => 299.99, 'rating' => 5, 'description' => 'První kniha z triologie J.R.R Tolkiena Pán Prstenů', 'category' => 1],
        ['name' => 'Harry Potter a kámen mudrců', 'img' => 'https://images-na.ssl-images-amazon.com/images/I/81YOuOGFCJL.jpg','price' => 218, 'rating' => 4, 'description' => 'První díl série o mladém kouzelníkovi Harry Potterovi od autorky J.K. Rowlingové', 'category' => 1],
        ['name' => 'Pes Baskervillský', 'img' => 'https://cdn.cosmicjs.com/27f0a6b0-e2b9-11e8-a268-811e2789828d-1192b8c61e2fddb2588da2cc9daf61f7.jpg','price' => 500, 'rating' => 3, 'category' => 2],
        ['name' => 'Spát v moři hvězd', 'img' => 'https://static.booktook.cz/files/photos/w/7/7689bd0660bb5bf3323614984c0acc0da05c2dcc.jpg?v=2','price' => 409, 'rating' => 4, 'description' => 'Kniha od autora Christophera Paoliniho, který je autorem série Odkaz Dračích Jezdců', 'category' => 2],
        ['name' => 'Vražda v Orient Expresu', 'img' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTn1-N0rlXXuv5ml50Y3H0KxtoX06QPt1V6wg&usqp=CAU','price' => 220, 'rating' => 4, 'description' => 'Další vyšetřování pro Hercula Poirota a přímo za jízdy v mezinárodním vlaku Orient Expresu', 'category' => 3],
        ['name' => 'Boris Becker', 'img' => 'https://images-na.ssl-images-amazon.com/images/I/515201D2XPL._SX340_BO1,204,203,200_.jpg','price' => 349.99, 'rating' => 2, 'category' => 4],
        ['name' => 'Pán Prstenů: Dvě Věže', 'img' => 'https://prodimage.images-bn.com/pimages/9780358380245_p0_v2_s550x406.jpg','price' => 345, 'rating' => 5, 'description' => 'Druhý díl z triologie Pána Prstenů od autora J.R.R. Tolkiena', 'category' => 1],
        ['name' => 'Pán Prstenů: Návrat Krále', 'img' => 'https://prodimage.images-bn.com/pimages/9780358380252_p0_v2_s550x406.jpg','price' => 400, 'rating' => 5, 'description' => 'Poslední díl z triologie Pána Prstenů od autora J.R.R. Tolkiena', 'category' => 1]
    ];

    foreach($products as $newProduct) {
        $productsDB->create($newProduct);
    }
    */

    //$products = $productsDB->fetchAll();
    $products = $productsDB->fetchAllOrderedBy([['name' => 'rating', 'order' => 'DESC'], ['name' => 'name']]);
?>

<?php foreach($products as $product): ?>
    <div class="col-lg-4 col-md-5 mb-4">
        <div class="card h-100 text-muted">
            <a href="#"><img class="card-img-top" src="<?php echo $product['img']; ?>" alt="<?php echo $product['name']; ?>"></a>
            <div class="card-body bg-light">
                <h4 class="card-title text-center">
                    <a href="#"><?php echo $product['name']; ?></a>
                </h4>
                <hr class="bg-primary">
                <h5 class="text-dark"><?php echo number_format($product['price'], 2, ',', ' '), ' ', CURRENCY; ?></h5>
                <?php if(isset($product['cat_name'])): ?>
                    <h5 class="card-text"><?php echo $product['cat_name']; ?></h5>
                <?php endif; ?>
                <?php if(isset($product['description'])): ?>
                    <p class="card-text"><?php echo $product['description']; ?></p>
                <?php endif; ?>
            </div>
            <div class="card-footer bg-warning">
                <small class="text-muted">
                    <?php for($i=0; $i<5; $i++): ?>
                        <?php echo $product['rating'] > $i ? '&#9733;' : '&#9734;' ?>
                    <?php endfor; ?>
                </small>
            </div>
        </div>
    </div>
<?php endforeach; ?>

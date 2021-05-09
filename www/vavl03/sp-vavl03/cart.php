<?php require __DIR__ . '/components/global.php'; ?>
<?php require __DIR__ . '/db/ProductsDB.php'; ?>
<?php
session_start();
require 'components/userRequired.php';
//session_destroy();

$ids = @$_SESSION['cart'];

if (is_array($ids) && count($ids)) {
    $idsForSql = [];
    foreach ($ids as $key => $value) {
        array_push($idsForSql, $key);
    }
    $question_marks = str_repeat('?,', count($idsForSql) - 1) . '?';
    $productsDB = new ProductsDB();
    $productsFromDb = $productsDB->fetchCartProducts($question_marks, $idsForSql);
    //$sum = $productsDB->fetchCartProductsPrice($question_marks,$idsForSql);
    $productsToShow = [];
    foreach ($productsFromDb as $product) {
        if (isset($ids[$product['product_id']])) {
            $product['product_pcs'] = $ids[$product['product_id']];
        }
        array_push($productsToShow, $product);
    }
    $productSums = [];
    foreach ($productsToShow as $product) {
        $productSum = $product['product_price'] * (int)$product['product_pcs'];
        array_push($productSums, $productSum);
    }
    var_dump($productSums);
    $sum = array_sum($productSums);
    # retezec s otazniky pro predani seznamu ids
    # pocet otazniku = pocet prvku v poli ids
    # pokud mam treba v ids 1,2,3, vrati mi ?,?,?

    /* var_dump(array_values($idsForSql));
   $stmt = $db->prepare("SELECT * FROM product WHERE product_id IN ($question_marks) ORDER BY product_name");
    # array values - setrepeme pole aby bylo indexovane od 0, jen kvuli dotazu, jinak neprojde
    $stmt->execute(array_values($idsForSql));
    $products = $stmt->fetchAll();

    $stmt_sum = $db->prepare("SELECT SUM(product_price) FROM product WHERE product_id IN ($question_marks)");
    # array values - setrepeme pole aby bylo indexovane od 0, jen kvuli dotazu, jinak neprojde
    $stmt_sum->execute(array_values($idsForSql));
    $sum = $stmt_sum->fetchColumn();*/
} else {
    $sum = 0;
}

# pocet jedontilich produktu v db
$productsDB = new ProductsDB();
function getProductPcs($productName)
{
    global $productsDB;
    $countPcs = $productsDB->fetchProductPcs($productName);
    return $countPcs;
}

function getProductPrice($productPrice, $productPcs)
{
    return $productPrice * (int)$productPcs;
}
?>




<?php include './incl/header.php' ?>
<?php include './incl/navbar.php' ?>
<main class="container cart">
    <h1 class="cart-headline">Your cart</h1>
    <div class="total-price">
        <div class="total-price-back-shopping">
            <a href="index.php"><i class="fas fa-arrow-left"></i> Back to shopping!</a>
            <h2 class="total-price">Total price: <span class="total-price-number"><?php echo htmlspecialchars($sum, ENT_QUOTES, 'UTF-8'); ?></span> <?php echo (GLOBAL_CURRENCY) ?></h2>
        </div>
        <?php if (@$sum > 0) : ?>
            <form action="components/startNewOrder.php">
                <button id="buy-btn" class="btn btn-primary btn-lg btn-cart-buy" type="submit">Buy</button>
            </form>
        <?php endif; ?>
    </div>
    <?php if (@$productsToShow) : ?>
        <div class="products">
            <?php foreach ($productsToShow as $row) : ?>
                <div class="card mb-3 cart-card" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="<?php echo $row['product_img']; ?>" alt="" class="cart-img">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($row['product_name'], ENT_QUOTES, 'UTF-8'); ?></h5>
                                <h6 class="product-price"><?php echo htmlspecialchars(number_format(getProductPrice($row['product_price'], $row['product_pcs']), 0, '.', ''), ENT_QUOTES, 'UTF-8') ?> <?php echo (GLOBAL_CURRENCY) ?></h6>
                                <label for="inputPcs" class="form-label">Pieces:</label>
                                <input type="number" name="<?php echo $row['product_name'] ?>" class="form-control pcs-input" id="inputPcs" max="<?php echo getProductPcs($row['product_name']) ?>" min="1" value="<?php echo htmlspecialchars($row['product_pcs'], ENT_QUOTES, 'UTF-8') ?>">
                                <form action="components/removeItem.php" method="POST">
                                    <input class="d-none" name="id" value="<?php echo htmlspecialchars($row['product_id'], ENT_QUOTES, 'UTF-8') ?>">
                                    <button type="submit" class="btn btn-danger btn-remove-item">Remove</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else : ?>
        <h5 class="color-white empty-cart">Your cart is empty :(</h5>
    <?php endif; ?>
</main>

<?php require './incl/footer.php'; ?>

<script>
    console.log(<?php echo json_encode($_SESSION); ?>);
    console.log(<?php echo json_encode($ids); ?>);
    console.log(<?php echo json_encode($idsForSql); ?>);
    console.log(<?php echo json_encode($question_marks); ?>);
    const products = <?php echo json_encode($productsToShow) ?>;
    console.log(products);
    // prevent pasting any values in Pieces input
    $("[type='number']").keypress(function(evt) {
        evt.preventDefault();
    });
    // disable products with only 1 piece
    $(".pcs-input").each((i, e) => {
        const max = $(e).attr('max');
        if (max == 1) {
            $(e).prop('disabled', true);
        }
    })
    // Update live prices on page
    $(".pcs-input").bind('keyup mouseup', async function() {
        //update individual product price
        const pcs = $(this).val();
        const name = $(this).siblings("h5").text();
        const productData = await jQuery.ajax({
            url: 'https://eso.vse.cz/4IZ278-2020-2021-LS/www/vavl03/sp-vavl03/components/getProduct.php', //CHANGE TO ESO VSE
            type: 'GET',
            data: {
                productName: name,
                productPcs: pcs,
                productsInCart: products
            },
            dataType: 'json',
            success: function(status, status_message, data) {
                console.log(status)
            },
            error: function(status, status_message, data) {
                console.log(status);
            }
        });
        const productPrice = productData.data;
        const newPrice = productPrice * pcs;
        $(this).siblings(".product-price").text(newPrice + " $");
        // update total price
        let productPrices = [];
        document.querySelectorAll(".product-price").forEach((list) => {
            productPrices.push(parseInt(list.innerHTML.split(".")[0]));
        });
        const newTotalPrice = productPrices.reduce((a, b) => a + b, 0);
        $('.total-price-number').text(newTotalPrice);

    })

    // create 'order' in php session with product names+quantity
    /*function buy() { 
     
        let order = {};
        $(".pcs-input").each(function() {
            order[$(this).attr("name")] = $(this).val();
        });
        console.log(order);
        jQuery.ajax({
            url: 'https://vcap.me/4IZ270-2020-2021-LS/www/vavl03/sp-vavl03/components/storeOrderItems.php', //CHANGE TO ESO VSE
            type: 'POST',
            data: {
                order: order,
            },
            dataType: 'json',
            success: function(data, textStatus, xhr) {
                console.log(data); // do with data e.g success message
            },
            error: function(xhr, textStatus, errorThrown) {
                console.log(textStatus.reponseText);
            }
        });

    }*/
</script>
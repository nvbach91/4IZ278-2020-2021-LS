<?php require __DIR__ . '/db/productsDB.php'; ?>
<?php
if (!isset($_SESSION)) {
    session_start();
}

$productsDB = new ProductsDB();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$ids = @$_SESSION['cart'];

if (is_array($ids) && count($ids)) {
    $question_marks = str_repeat('?,', count($ids) - 1) . '?';
    $products = $productsDB->fetchCartProducts($question_marks, $ids);
    $priceTotal = $productsDB->sumPrice($question_marks, $ids);
}

?>

<?php include __DIR__ . '/includes/header.php'; ?>
<?php include __DIR__ . '/includes/nav.php'; ?>
<main class="container-sm">
    <div class="text-center mb-2">
        <h1>Cart</h1>
    </div>
    <?php if (@$products) : ?>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product) : ?>
                    <tr>
                        <th scope="row"><img class="cart-thumbnail" src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>"></th>
                        <td><?php echo $product['name'] ?></td>
                        <td><?php echo $product['price'] , ' ', CURRENCY; ?></td>
                        <td><a href="remove.php?id=<?php echo $product['id'] ?>" class="btn btn-primary">Remove</a></td>
                    </tr>
                <?php endforeach; ?>
                    <tr>
                        <th scope="row" colspan="2">Total:</th>
                        <td><?php echo $priceTotal , ' ', CURRENCY; ?></td>
                        <td><a class="btn btn-dark" href="">Order</a></td>
                    </tr>
            </tbody>
        </table>
    <?php else : ?>
        <h3>Cart is empty</h3>
    <?php endif; ?>
</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
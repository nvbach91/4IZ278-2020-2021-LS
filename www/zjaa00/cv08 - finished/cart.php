<?php

require './_inc/config.php';
require 'user_required.php'; // pristup jen pro prihlaseneho uzivatele


if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
$goods = [];
$ids = $_SESSION['cart'];

if (is_array($ids) && count($ids)) {
    $question_marks = str_repeat('?,', count($ids) - 1) . '?';

    $stmt = $connect->prepare("SELECT * FROM goods WHERE id IN (${question_marks}) ORDER BY name");
    // array_values - vrati poled indexovane od 0, napr [42, 47, 63, 12, 44]
    $stmt->execute(array_values($ids));
    $goods = $stmt->fetchAll();

    $stmt_sum = $connect->prepare("SELECT SUM(price) FROM goods WHERE id IN (${question_marks})");
    $stmt_sum->execute(array_values($ids));
    $sum = $stmt_sum->fetchColumn();
}

?>

<?php require __DIR__ . '/partials/header.php' ?>
<main class="container">
    <h1>My shopping cart</h1>
    Total goods selected: <?php echo count($goods); ?>
    <br><br>
    <a href="index.php">Back to the goods</a>
    <br><br>
    <?php if ($goods): ?>
        <div class="goods">
            <div class="good">
                <div></div>
                <div>Name</div>
                <div>Price</div>
                <div>Description</div>
                <div>&nbsp;</div>
            </div>
            <?php foreach ($goods as $good): ?>
            <div class="good">
                <div><a href='remove.php?id=<?php echo $good['id']; ?>'>Remove</a></div>
                <div><?php echo $good['name']; ?></div>
                <div><?php echo $good['price']; ?></div>
                <div><?php echo substr($good['description'], 0, 50) . '...'; ?></div>
                <div>&nbsp;</div>
            </div>
            <?php endforeach; ?>
        </div>
        <br>
        <div>Total: <strong><?php echo $sum; ?></strong></div>
    <?php else: ?>
        <div>No goods yet</div>
    <?php endif; ?>
</main>
<div style="margin-bottom: 600px"></div>
<?php require __DIR__ . '/partials/footer.php' ?>

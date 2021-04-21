<?php
    require __DIR__ . '/user-required.php';
    require __DIR__ . '/includes/header.php';
    require __DIR__ . '/db.php';

    $goodsIds = @$_SESSION['cart'];
    $offset = isset($_SESSION['offset']) ? $_SESSION['offset'] : 0;

    if ($goodsIds && is_array($goodsIds) && count($goodsIds)) {
        $idSet = implode(', ', $goodsIds);
        $stmt = $pdo->prepare("SELECT * FROM goods WHERE id IN ($idSet) ORDER BY name");
        $stmt->execute();
        $goods = $stmt->fetchAll();

        $stmt_sum = $pdo->prepare("SELECT SUM(price) FROM goods WHERE id IN ($idSet)");
        $stmt_sum->execute();
        $sum = $stmt_sum->fetchColumn();
    } else {
        $goods = [];
    }
?>

<main class="container">
    <h1 class="my-4 text-center">Shopping Cart</h1>

    <a class="btn btn-light mb-3" href="index.php?offset=<?php echo $offset; ?>"><i class="fas fa-arrow-left mr-2"></i>Go Back</a>

    <?php if(empty($goods)): ?>
        <h2>No Items entered yet.</h2>
    <?php else: ?>
        <h2>Mango Items: <?php echo count($goods); ?></h2>

        <div class="goods-cart row">
            <?php foreach ($goods as $good) : ?>
                <div class="card mb-3 text-dark pr-4">
                    <div class="row no-gutters">
                        <div style="max-width: 200px;">
                            <img src="<?php echo $good['img']; ?>" class="card-img" alt="<?php echo $good['name']; ?>">
                        </div>
                        <div style="max-width: 350px;">
                            <div class="card-body">
                                <h3 class="card-title"><?php echo $good['name']; ?></h3>
                                <p class="card-text"><?php echo $good['description']; ?></p>
                                <h4><?php echo number_format($good['price'], 2, ',', ' '), ' CZK'; ?></h4>
                            </div>
                        </div>
                        <div>
                            <a class="btn btn-danger" href="remove-item.php?id=<?php echo $good['id']; ?>"><i class="fas fa-times"></i></a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
<?php require __DIR__ . '/database_connection.php';

session_start();
$ids = @$_SESSION['cart'];
if (is_array($ids) && count($ids)) {

    $question_marks = str_repeat('?,', count($ids) - 1) . '?';

    $stmt = $pdo->prepare("SELECT * FROM goods WHERE id IN ($question_marks) ORDER BY name");
    $stmt->execute(array_values($ids));
    $goods = $stmt->fetchAll();


    $stmt_sum = $pdo->prepare("SELECT SUM(price) FROM goods WHERE id IN ($question_marks)");
    $stmt_sum->execute(array_values($ids));
    $sum = $stmt_sum->fetchColumn();
}
?>

<?php include __DIR__ . '/includes/header.php' ?>
<main>
    <h1>shopping cart</h1>
    <?php if (@$goods) : ?>
        <div class="goods">
            <?php foreach ($goods as $good) : ?>
                <div class="card good" style="width: 18rem;">
                    <img class="card-img-top" src="<?php echo $good['img']; ?>" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $good['name']; ?></h5>
                        <h5><?php echo $good['price'] , ' ', CURRENCY; ?></h5>
                        <p class="card-text"><?php echo $good['description']; ?></p>
                        <form action="remove.php" method="POST">
                            <a href="remove.php?id=<?php echo $good['id'] ?>" class="btn btn-primary">Delete</a>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else : ?>
        <h3>No goodies</h3>
    <?php endif; ?>

</main>
<?php include __DIR__ . '/includes/footer.php' ?>
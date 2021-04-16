<?php

require __DIR__ . '/db.php';

session_start();

$ids = @$_SESSION['cart'];
if (is_array($ids) && count($ids)) {

    $question_marks = str_repeat('?,', count($ids) - 1) . '?';

    $statement = $pdo->prepare("SELECT * FROM goods WHERE id IN ($question_marks) ORDER BY name");

    $statement->execute(array_values($ids));
    $goods = $statement->fetchAll();


    $stmt_sum = $pdo->prepare("SELECT SUM(price) FROM goods WHERE id IN ($question_marks)");
    $stmt_sum->execute(array_values($ids));
    $sum = $stmt_sum->fetchColumn();
}

?>

<?php require __DIR__ . '/includes/header.php'; ?>
<main class="container">
    <div id="shopping-cart">
        <h1>Shopping cart</h1>
        <br><br>
        Total goods selected: <?php
                                if (empty($goods)) echo "0";
                                else echo @count($goods);
                                ?>
        <br><br>
        <?php if (@$goods) : ?>
            <table class="tbl-cart" cellpadding="10" cellspacing="1" style="border-collapse: separate">
                <tbody>
                    <tr>
                        <th style="text-align:left;">Name</th>
                        <th style="text-align:right;" width="10%">Quantity</th>
                        <th style="text-align:right;" width="10%">Unit Price</th>
                        <th style="text-align:right;" width="10%">Price</th>
                        <th style="text-align:center;" width="5%">Remove</th>
                    </tr>
                    <?php
                    foreach ($goods as $row) :
                    ?>
                        <tr>
                            <td><img src="<?php echo $row["img"]; ?>" class="cart-item-image" width="80" height="60" /><?php echo $row["name"]; ?></td>
                            <td style="text-align:right;">1</td>
                            <td style="text-align:right;"><?php echo $row["price"] . " Kč"; ?></td>
                            <td style="text-align:right;"><?php echo $row["price"] . " Kč"; ?></td>
                            <td>
                                <form action="remove-item.php" method="POST">
                                    <input class="d-none" name="id" value="<?php echo $row['id'] ?>">
                                    <button type="submit" class="btn btn-danger">Remove</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td style="text-align:left;"><strong>Total:</strong></td>
                        <td style="text-align:right;"><strong><?= @count($goods) ?></strong></td>
                        <td style="text-align:right;"><strong>-</strong></td>
                        <td style="text-align:right;"><strong><?php echo $sum . " Kč"; ?></strong></td>
                        <td>
                            <button type="submit" class="btn btn-dark">Checkout</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        <?php else : ?>
            <h5>No goods yet</h5>
        <?php endif; ?>
</main>
<?php require __DIR__ . '/includes/footer.php'; ?>
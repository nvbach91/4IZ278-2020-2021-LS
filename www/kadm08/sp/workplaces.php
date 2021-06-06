<?php
session_start();

require __DIR__ . '/db.php';


$stmt = $pdo->prepare("SELECT * FROM workplace ORDER BY ws_id ASC");
$stmt->execute();
$workplaces = $stmt->fetchAll();



?>


<?php require __DIR__ . '/includes/header.php'; ?>
<main class="container">
    <h1>Workplaces</h1>
    <br><br>
    <a class="btn btn-primary" href="newWorkplace.php">Add new workplace</a>
    <br><br>
    <?php if (@$workplaces) : ?>
    <table class="tbl-cart" cellpadding="10" cellspacing="1" style="border-collapse: separate">
        <tbody>
            <tr>
                <th style="text-align:left;">ID</th>
                <th style="text-align:right;">Name</th>
                <th style="text-align:right;" >Price per day</th>
                <th style="text-align:right;" >Active</th>
            </tr>
            <?php foreach ($workplaces as $workplace) : ?>
                <tr>
                    <td style="text-align:right;"><?php echo $workplace["ws_id"]; ?></td>
                    <td style="text-align:right;"><?php echo $workplace["name"]; ?></td>
                    <td style="text-align:right;"><?php echo $workplace["price_per_day"]; ?></td>
                    <td style="text-align:right;"><?php if ($workplace["active"] == 0) {echo "inactive";} else {echo "active";} ?></td>
                    <td>
                        <a class="btn btn-link" href="editWorkplace.php?ws_id=<?php echo $workplace['ws_id'] ?>">Edit</a>
                    </td>
                    <td>
                        <form action="removeWorkplace.php?ws_id=<?php echo $workplace['ws_id'] ?>" method="POST">
                            <button type="submit" class="btn btn-danger">Remove</button>
                        </form>
                    </td>
                    <td>
                        <form action="changeActive.php?ws_id=<?php echo $workplace['ws_id'] ?>" method="POST">
                            <button type="submit" class="btn btn-danger"><?php if ($workplace["active"] == 0) {echo "Activate";} else {echo "Deactivate";}?></button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        </table>
        <?php else : ?>
            <h5>No worplaces yet</h5>
        <?php endif; ?>
</main>
<?php require __DIR__ . '/includes/footer.php'; ?>
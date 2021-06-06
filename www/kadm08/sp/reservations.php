
<?php
session_start();

require __DIR__ . '/db.php';
require __DIR__ . '/adminRequired.php';


$stmt = $pdo->prepare(<<<EOT
SELECT * FROM wp_reservation wp 
JOIN client c ON wp.client_id = c.client_id  
ORDER BY reservation_id ASC;
EOT);
$stmt->execute();
$reservations = $stmt->fetchAll();

?>

<?php require __DIR__ . '/includes/header.php'; ?>
<main class="container">
    <br><br> <br><br>
    <h1>Reservations</h1>
    <br>
    <a class="btn btn-primary" href="newReservation.php">Add new reservation</a>
    <br><br>
    <?php if (@$reservations) : ?>
    <table class="tbl-cart" cellpadding="10" cellspacing="1" style="border-collapse: separate">
        <tbody>
        <tr class="table-active">
                <th style="text-align:left;">ID</th>
                <th style="text-align:right;">Client</th>
                <th style="text-align:right;">Workplace</th>
                <th style="text-align:right;" >Reservation start</th>
                <th style="text-align:right;" >Reservation end</th>
                <th style="text-align:right;" >Reservation created</th>
                <th style="text-align:right;" >Total price</th>
                <th style="text-align:right;" >Paid</th>
                <th style="text-align:right;" >Delete</th>
                <th style="text-align:right;" >Pay</th>
            </tr>
            <?php foreach ($reservations as $reservation) : ?>
                <tr class="table-default">
                    <td style="text-align:right;"><?php echo $reservation["reservation_id"]; ?></td>
                    <td style="text-align:right;"><?php echo $reservation["name"]." ". $reservation["surname"]; ?></td>
                    <td style="text-align:right;"><?php echo $reservation["ws_id"]; ?></td>
                    <td style="text-align:right;"><?php echo $reservation["reservation_start"]; ?></td>
                    <td style="text-align:right;"><?php echo $reservation["reservation_end"]; ?></td>
                    <td style="text-align:right;"><?php echo $reservation["reservation_created"]; ?></td>
                    <td style="text-align:right;"><?php echo $reservation["total_price"]; ?></td>
                    <td style="text-align:right;"><?php if ($reservation["reservation_paid"] == 0) {echo "unpaid";} else {echo "paid";} ?></td>
                    <td>
                        <form action="deleteReservation.php?reservation_id=<?php echo $reservation['reservation_id'] ?>" method="POST">
                            <input class="d-none" name="id" value="">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                    <td>
                        <form action="changePaid.php?reservation_id=<?php echo $reservation['reservation_id'] ?>" method="POST">
                            <input class="d-none" name="id" value="">
                            <button type="submit" class="btn btn-danger"><?php if ($reservation["reservation_paid"] == 0) {echo "Mark as paid";} else {echo "Mark as unpaid";}?></button>
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
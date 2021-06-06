<?php
session_start();

require __DIR__ . '/db.php';
require __DIR__ . '/user_required.php';


$stmt = $pdo->prepare("SELECT * FROM wp_reservation wp 
                        LEFT JOIN client c on wp.client_id = c.client_id
                        WHERE c.user_id = :user_id 
                        ORDER BY reservation_id ASC");
$stmt->execute(['user_id' => $_GET['user_id']]);
$reservations = $stmt->fetchAll();



?>

<?php require __DIR__ . '/includes/header.php'; ?>
<main class="container">
    <br><br> <br><br>
    <h1>Reservations</h1>
    <br><br>
    <a class="btn btn-primary" href="newReservation.php">Add new reservation</a>
    <br><br>
    <h4> Active reservations </h3>
    <?php if (@$reservations) : ?>
        <table class="tbl-cart" cellpadding="10" cellspacing="1" style="border-collapse: separate">
            <tbody>
                <tr>
                    <th style="text-align:left;">ID</th>
                    <th style="text-align:right;">Client</th>
                    <th style="text-align:right;">Workplace</th>
                    <th style="text-align:right;">Reservation start</th>
                    <th style="text-align:right;">Reservation end</th>
                    <th style="text-align:right;">Reservation created</th>
                    <th style="text-align:right;">Total price</th>
                    <th style="text-align:right;">Paid</th>
                </tr>
                <?php foreach ($reservations as $reservation) : ?>
                    <?php if ($reservation["reservation_start"] >= date("Y-m-d")) { ?>
                    <tr class="table-success">
                        <td style="text-align:right;"><?php echo $reservation["reservation_id"]; ?></td>
                        <td style="text-align:right;"><?php echo $reservation["client_id"]; ?></td>
                        <td style="text-align:right;"><?php echo $reservation["ws_id"]; ?></td>
                        <td style="text-align:right;"><?php echo $reservation["reservation_start"]; ?></td>
                        <td style="text-align:right;"><?php echo $reservation["reservation_end"]; ?></td>
                        <td style="text-align:right;"><?php echo $reservation["reservation_created"]; ?></td>
                        <td style="text-align:right;"><?php echo "1000 Kč" ?></td>
                        <td style="text-align:right;"><?php if ($reservation["reservation_paid"] == 0) {
                                                            echo "unpaid";
                                                        } else {
                                                            echo "paid";
                                                        } ?></td>
                    </tr>
                    <?php     } ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <h5>No worplaces yet</h5>
    <?php endif; ?>
    <br><br>
    <h4> Past reservations </h3>
    <?php if (@$reservations) : ?>
        <table class="tbl-cart" cellpadding="10" cellspacing="1" style="border-collapse: separate">
            <tbody>
                <tr>
                    <th style="text-align:left;">ID</th>
                    <th style="text-align:right;">Client</th>
                    <th style="text-align:right;">Workplace</th>
                    <th style="text-align:right;">Reservation start</th>
                    <th style="text-align:right;">Reservation end</th>
                    <th style="text-align:right;">Reservation created</th>
                    <th style="text-align:right;">Total price</th>
                    <th style="text-align:right;">Paid</th>
                </tr>
                <?php foreach ($reservations as $reservation) : ?>
                    <?php if ($reservation["reservation_start"] < date("Y-m-d")) { ?>
                    <tr class="table-info">
                        <td style="text-align:right;"><?php echo $reservation["reservation_id"]; ?></td>
                        <td style="text-align:right;"><?php echo $reservation["client_id"]; ?></td>
                        <td style="text-align:right;"><?php echo $reservation["ws_id"]; ?></td>
                        <td style="text-align:right;"><?php echo $reservation["reservation_start"]; ?></td>
                        <td style="text-align:right;"><?php echo $reservation["reservation_end"]; ?></td>
                        <td style="text-align:right;"><?php echo $reservation["reservation_created"]; ?></td>
                        <td style="text-align:right;"><?php echo "1000 Kč" ?></td>
                        <td style="text-align:right;"><?php if ($reservation["reservation_paid"] == 0) {
                                                            echo "unpaid";
                                                        } else {
                                                            echo "paid";
                                                        } ?></td>
                    </tr>
                    <?php     } ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <h5>No worplaces yet</h5>
    <?php endif; ?>
</main>
<?php require __DIR__ . '/includes/footer.php'; ?>
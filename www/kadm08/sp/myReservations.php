<?php
session_start();

require __DIR__ . '/db.php';
require __DIR__ . '/userRequired.php';
require_once __DIR__ . '/lib/ReservationDB.php';


$reservationDB = new ReservationDB();
$reservations = $reservationDB->fetchByClient($_SESSION['client_id']);


?>

<?php require __DIR__ . '/includes/header.php'; ?>
    <main class="container">
        <br><br> <br><br>
        <h1>Reservations</h1>
        <br>
        <h6><a href="contact.php" class="link-info">Contact us in order to make changes in your reservation.</a></h6>
        <br>
        <a class="btn btn-primary" href="newReservation.php">Add new reservation</a>
        <br><br>
        <h3> Active reservations </h3>
            <?php if (!empty($reservations)) : ?>
                <table class="tbl-cart" cellpadding="10" cellspacing="1" style="border-collapse: separate">
                    <tbody>
                    <tr>
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
                                <td style="text-align:right;"><?php echo $reservation["name"]; ?></td>
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
                        <?php } ?>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else : ?>
                <h5>No reservations yet</h5>
            <?php endif; ?>
            <br><br>
            <h3> Past reservations </h3>
                <?php if (!empty($reservations)) : ?>
                    <table class="tbl-cart" cellpadding="10" cellspacing="1" style="border-collapse: separate">
                        <tbody>
                        <tr>
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
                                    <td style="text-align:right;"><?php echo $reservation["name"]; ?></td>
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
                            <?php } ?>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else : ?>
                    <h5>No reservations yet</h5>
                <?php endif; ?>
    </main>
<?php require __DIR__ . '/includes/footer.php'; ?>
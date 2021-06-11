<?php
session_start();

require __DIR__ . '/userRequired.php';
require_once __DIR__ . '/lib/ReservationDB.php';


$reservationDB = new ReservationDB();
$reservations = $reservationDB->fetchByClient($_SESSION['client_id']);


?>

<?php require __DIR__ . '/includes/header.php'; ?>
<main class="container">
    <h1>Reservations</h1>
    <ul>
        <h6><a href="contact.php" class="link-info">Contact us</a> in order to make changes in your reservation.</a></h6>
    </ul>
    <ul>
        <a class="btn btn-primary" href="newReservation.php">Add new reservation</a>
    </ul>
    <h3> Active reservations </h3>
    <?php if (!empty($reservations)) : ?>
        <table class="tbl-cart" cellpadding="10" cellspacing="1" style="border-collapse: separate">
            <tbody>
                <tr class="table-primary">
                    <th style="text-align:left;">Workplace</th>
                    <th style="text-align:right;">Reservation start</th>
                    <th style="text-align:right;">Reservation end</th>
                    <th style="text-align:right;">Reservation created</th>
                    <th style="text-align:right;">Total price</th>
                    <th style="text-align:center;">Paid</th>
                    <th style="text-align:right;">Delete</th>
                </tr>
                <?php foreach ($reservations as $reservation) : ?>
                    <?php if ($reservation["reservation_start"] >= date("Y-m-d")) { ?>
                        <tr class="table-light">
                            <td style="text-align:left;"><?php echo $reservation["name"]; ?></td>
                            <td style="text-align:right;"><?php echo $reservation["reservation_start"]; ?></td>
                            <td style="text-align:right;"><?php echo $reservation["reservation_end"]; ?></td>
                            <td style="text-align:right;"><?php echo $reservation["reservation_created"]; ?></td>
                            <td style="text-align:right;"><?php echo $reservation["total_price"] . " Kč" ?></td>
                            <td style="text-align:center;"><?php if ($reservation["reservation_paid"] == 0) {
                                                                echo "unpaid";
                                                            } else {
                                                                echo "paid";
                                                            } ?></td>
                            <td>
                                <form action="deleteReservation.php?reservation_id=<?php echo $reservation['reservation_id'] ?>" method="POST">
                                    <input class="d-none" name="id" value="">
                                    <button type="submit" class="btn btn-danger ">Delete</button>
                                </form>
                            </td>
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
                <tr class="table-primary">
                    <th style="text-align:left;">Workplace</th>
                    <th style="text-align:right;">Reservation start</th>
                    <th style="text-align:right;">Reservation end</th>
                    <th style="text-align:right;">Reservation created</th>
                    <th style="text-align:right;">Total price</th>
                    <th style="text-align:center;">Paid</th>
                </tr>
                <?php foreach ($reservations as $reservation) : ?>
                    <?php if ($reservation["reservation_start"] < date("Y-m-d")) { ?>
                        <tr class="table-secondary">
                            <td style="text-align:left;"><?php echo $reservation["name"]; ?></td>
                            <td style="text-align:right;"><?php echo $reservation["reservation_start"]; ?></td>
                            <td style="text-align:right;"><?php echo $reservation["reservation_end"]; ?></td>
                            <td style="text-align:right;"><?php echo $reservation["reservation_created"]; ?></td>
                            <td style="text-align:right;"><?php echo $reservation["total_price"] . " Kč" ?></td>
                            <td style="text-align:center;"><?php if ($reservation["reservation_paid"] == 0) {
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
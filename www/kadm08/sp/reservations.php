<?php
session_start();

require __DIR__ . '/adminRequired.php';
require_once __DIR__ . '/lib/ReservationDB.php';


$reservationDB = new ReservationDB();
$reservations = $reservationDB->fetchAllItems();

?>

<?php require __DIR__ . '/includes/header.php'; ?>
<main class="container">
    <h1>Reservations</h1>
    <ul>
        <a class="btn btn-primary" href="newReservation.php">Add new reservation</a>
    </ul>
    <?php if (!empty($reservations)) : ?>
        <table class="tbl-cart" cellpadding="10" cellspacing="1" style="border-collapse: separate">
            <tbody>
                <tr class="table-active">
                    <th style="text-align:left;">ID</th>
                    <th style="text-align:left;">Client</th>
                    <th style="text-align:right;">Workplace</th>
                    <th style="text-align:right;">Reservation start</th>
                    <th style="text-align:right;">Reservation end</th>
                    <th style="text-align:right;">Reservation created</th>
                    <th style="text-align:right;">Total price</th>
                    <th style="text-align:right;">Paid</th>
                    <th style="text-align:right;">Paid</th>
                    <th style="text-align:right;">Edit</th>
                    <th style="text-align:center;">Pay</th>
                </tr>
                <?php foreach ($reservations as $reservation) : ?>
                    <tr class="table-default">
                        <td style="text-align:left;"><?php echo $reservation["reservation_id"]; ?></td>
                        <td style="text-align:left;"><?php echo $reservation["name"] . " " . $reservation["surname"]; ?></td>
                        <td style="text-align:right;"><?php echo $reservation["ws_id"]; ?></td>
                        <td style="text-align:right;"><?php echo $reservation["reservation_start"]; ?></td>
                        <td style="text-align:right;"><?php echo $reservation["reservation_end"]; ?></td>
                        <td style="text-align:right;"><?php echo $reservation["reservation_created"]; ?></td>
                        <td style="text-align:right;"><?php echo $reservation["total_price"]; ?></td>
                        <td style="text-align:right;"><?php if ($reservation["reservation_paid"] == 0) {
                                                            echo "unpaid";
                                                        } else {
                                                            echo "paid";
                                                        } ?></td>
                        <td>
                            <form action="deleteReservation.php?reservation_id=<?php echo $reservation['reservation_id'] ?>" method="POST">
                                <input class="d-none" name="id" value="">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                        <?php if ($reservation["reservation_end"] > $_SERVER['REQUEST_TIME']) { ?>
                            <td>
                                <a class="btn btn-warning" href="editReservation.php?reservation_id=<?php echo $reservation['reservation_id'] ?>">Edit</a>
                            </td>
                        <?php } else { ?>
                            <td style="text-align:cenyter;"><?php echo "Expired"; ?></td>
                        <?php } ?>

                        <td>
                            <form action="changePaid.php?reservation_id=<?php echo $reservation['reservation_id'] ?>" method="POST">
                                <input class="d-none" name="id" value="">
                                <button type="submit" class="btn btn-secondary"><?php if ($reservation["reservation_paid"] == 0) {
                                                                                    echo "Mark as paid";
                                                                                } else {
                                                                                    echo "Mark as unpaid";
                                                                                } ?></button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <h5>No reservaions yet</h5>
    <?php endif; ?>
</main>
<?php require __DIR__ . '/includes/footer.php'; ?>
<?php
session_start();

require __DIR__ . '/adminRequired.php';
require_once __DIR__ . '/lib/ReservationDB.php';

$success = false;

$errorMessages = [];
$reservationDB = new ReservationDB();


if (!empty($_POST['start']) && !empty($_POST['end'])) {

    if ($_POST['start'] > $_POST['end']) {
        array_push($errorMessages,   'Reservation end cannot be before reservation start.');
    }

    if ($_POST['start'] < date("Y-m-d")) {
        array_push($errorMessages,   'Reservation cannot be in the past.');
    }
}

if ('POST' == $_SERVER['REQUEST_METHOD'] and empty($errorMessages)) {
    if (!empty($_POST)) {

        $available_workplaces = $reservationDB->getAvailableWorkplaceForUpdate($_GET['reservation_id'], htmlspecialchars(@$_POST['end']), htmlspecialchars(@$_POST['start']));

        if (!empty($available_workplaces) && empty($errorMessages)) {
            $available_workplace = $available_workplaces[0];
            $start = strtotime($_POST['start']);
            $end = strtotime($_POST['end']);
            $total_price = $available_workplace['price_per_day'] * (round(abs($end - $start) / (60 * 60 * 24)) + 1);
            $days_of_reservation = round(abs($end - $start) / (60 * 60 * 24)) + 1;

            $update_reservation = $reservationDB->updateItem($_GET['reservation_id'], $_POST['start'], $_POST['end'], $available_workplace['ws_id'], $total_price, $days_of_reservation);
            $success = true;
        } else {
            array_push($errorMessages,   'There are no available workspaces in the selected time period.');
        }
    }
}

$reservation = $reservationDB->fetchById($_GET['reservation_id']);


?>


<?php require __DIR__ . '/includes/header.php'; ?>
<main class="container">
    <h1>Edit a reservation</h1>
    <ul>
        <?php foreach ($errorMessages as $message) : ?>
            <div class="error" style="color:red;"><?php echo  $message; ?></div>
        <?php endforeach; ?>
        <?php if ($success) : ?>
            <div class="success" style="color:green;">You have successfully edited a reservation</div>
        <?php endif; ?>
    </ul>
    <form method="POST">
        <div class="form-group">
            <label for="id">ID</label>
            <input readonly class="form-control" id="id" name="id" value="<?= $reservation['reservation_id'] ?>" />
            <label for="name">Client</label>
            <input readonly class="form-control" id="name" name="name" value="<?= $reservation['name'] . " " . $reservation['surname'] ?>" />
            <label for="name">Workplace</label>
            <input readonly class="form-control" id="name" name="name" value="<?= $reservation['wp_name'] ?>" />
            <label for="price">Reservation start</label>
            <input type="date" class="form-control" id="start" name="start" value="<?= $reservation['reservation_start'] ?>" />
            <label for="price">Reservation end</label>
            <input type="date" class="form-control" id="end" name="end" value="<?= $reservation['reservation_end'] ?>" />
        </div>
        <div class="btn-wrapper text-center justify-content-between">
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="reservations.php" class="btn btn-primary">Go to reservations</a>
        </div>
    </form>
    <div style="margin-bottom: 600px"></div>
</main>
<?php require __DIR__ . '/includes/footer.php'; ?>
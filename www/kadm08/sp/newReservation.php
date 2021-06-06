<?php
session_start();


require __DIR__ . '/db.php';
require __DIR__ . '/userRequired.php';

$success = false;

$errorMessages = [];


$stmt = $pdo->prepare("SELECT * FROM client ORDER BY client_id ASC");
$stmt->execute();
$available_clients = $stmt->fetchAll();


if (!empty($_POST)) {
    if (empty($_POST['start']) || empty($_POST['end'])) {
        array_push($errorMessages,   'You have to select starting and ending dates.');
    }

    $stmt = $pdo->prepare(<<<EOT
    SELECT * FROM workplace 
    WHERE (active = 1) 
    AND ws_id NOT IN 
        (SELECT ws_id FROM wp_reservation 
        WHERE (reservation_start <= :reservation_end) and (reservation_end >= :reservation_start));
EOT);
    $stmt->execute([
        'reservation_start' => htmlspecialchars($_POST['start']),
        'reservation_end' => htmlspecialchars($_POST['end'])
    ]);

    $available_workplaces = $stmt->fetchAll();

    if ($_POST['start'] > $_POST['end']) {
        array_push($errorMessages,   'Reservation end cannot be before reservation start.');
    }

    if (empty($available_workplaces)) {
        array_push($errorMessages,   'There are no available workspaces in the selected time period.');
    } elseif (empty($errorMessages)) {
        $available_workplace = $available_workplaces[0];
        $start = strtotime($_POST['start']);
        $end = strtotime($_POST['end']);

        if(isset($_SESSION['type']) && $_SESSION['type'] == 1) {
        $stmt = $pdo->prepare("
                             INSERT INTO wp_reservation (reservation_created, reservation_start, reservation_end, total_price, client_id, ws_id, days_of_reservation) 
                             VALUES (NOW(), :start, :end, :total_price, :client, :ws_id, :days_of_reservation)                                           
                             ");

        $stmt->execute([
            "start" => htmlspecialchars($_POST['start']),
            "end" => htmlspecialchars($_POST['end']),
            "total_price" => $available_workplace['price_per_day'] * (round(abs($end - $start)/ (60 * 60 * 24)) + 1),
            "client" => htmlspecialchars($_POST['client']),
            "ws_id" => $available_workplace['ws_id'],
            "days_of_reservation" => round(abs($end - $start)/ (60 * 60 * 24)) + 1
        ]);
        $success = true;
        }
        elseif (isset($_SESSION['type']) && $_SESSION['type'] == 0) {
            $stmt = $pdo->prepare("
                                 INSERT INTO wp_reservation (reservation_created, reservation_start, reservation_end, total_price, client_id, ws_id, days_of_reservation) 
                                 VALUES (NOW(), :start, :end, :total_price, :client, :ws_id, :days_of_reservation)                                           
                                 ");
    
            $stmt->execute([
                "start" => htmlspecialchars($_POST['start']),
                "end" => htmlspecialchars($_POST['end']),
                "total_price" => $available_workplace['price_per_day'] * (round(abs($end - $start)/ (60 * 60 * 24)) + 1),
                "client" =>$_SESSION['client_id'],
                "ws_id" => $available_workplace['ws_id'],
                "days_of_reservation" => round(abs($end - $start)/ (60 * 60 * 24)) + 1
            ]);
            $success = true;
            }

    }
}
?>


<?php require __DIR__ . '/includes/header.php'; ?>
<main class="container">
    <br /><br /><br /><br />
    <h1>Create new reservation</h1>
    <ul>
        <?php foreach ($errorMessages as $message) : ?>
            <p style="color:red;"><?php echo $message; ?></p>
        <?php endforeach; ?>
        <?php if ($success) : ?>
            <div class="success" style="color:green;">You have successfully created a reservation</div>
        <?php endif; ?>
    </ul>

    <form method="POST">
        <div class="form-group">
            <?php if (isset($_SESSION['type']) && $_SESSION['type'] == 1) : ?>
                <label class="mr-sm-2" for="inlineFormCustomSelect">Select client:</label>
                <select name="client" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                    <?php
                    foreach ($available_clients as $client) { ?>
                        <option value="<?= $client['client_id'] ?>"><?= $client['name'] . " " . $client['surname'] ?></option>
                    <?php
                    } ?>
                </select>
        </div>
    <?php endif; ?>

    <div class="form-group">
        <label for="start">When would you like your reservation to start?</label>
        <input type="date" name="start" class="form-control" id="start" placeholder="">
    </div>
    <div class="form-group">
        <label for="end">When would you like your reservation to end?</label>
        <input type="date" name="end" class="form-control" id="end" placeholder="">
    </div>
    <div class="btn-wrapper text-center justify-content-between">
        <?php if (isset($_SESSION['type']) && $_SESSION['type'] == 1) : ?>
            <button type="submit" class="btn btn-primary">Add</button>
            <a href="reservations.php" class="btn btn-primary">Go back to reservations</a>
        <?php elseif (isset($_SESSION['type']) && $_SESSION['type'] == 0) : ?>
            <button type="submit" class="btn btn-primary">Add</button>
            <a href="myReservations.php?user_id=<?php echo $_SESSION['user_id'] ?>" class="btn btn-primary">Go back to my reservations</a>
        <?php endif; ?>
    </form>
    <div style="margin-bottom: 600px"></div>
</main>
<?php require __DIR__ . '/includes/footer.php'; ?>
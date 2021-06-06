<?php
session_start();


require __DIR__ . '/db.php';
require __DIR__ . '/user_required.php';

$success = false;

$errorMessages = [];


$stmt = $pdo->prepare("SELECT * FROM client ORDER BY client_id ASC");
$stmt->execute();
$available_clients = $stmt->fetchAll();

if (!empty($_POST)) {
    $stmt = $pdo->prepare("SELECT * FROM workplace
                            WHERE (ws_id NOT IN (SELECT ws_id FROM wp_reservation))
                            OR ((ws_id IN 
    	                    (SELECT ws_id 
     	                    FROM 
     	                	(SELECT ws_id, MAX(reservation_start) AS max_start
			                FROM wp_reservation GROUP BY ws_id) as table1 
     	                    WHERE (max_start > :reservation_end) OR (max_start < :reservation_start))
   	                        ) AND 
                            (ws_id IN 
    	                    (SELECT ws_id 
                        	FROM 
     	                	(SELECT ws_id, MIN(reservation_end) AS min_end
		                	FROM wp_reservation GROUP BY ws_id) as table2
     	                    WHERE (min_end < :reservation_start) OR (min_end > :reservation_end))
                          	) AND (active = 1)
                            )LIMIT 1;");
    $stmt->execute([
        'reservation_start' => $_POST['start'],
        'reservation_end' => $_POST['end']
    ]);
    $available_workplace = $stmt->fetchAll()[0];

    if (empty($available_workplace)) {
        array_push($errorMessages,   'There are no available workspaces in the selected time period.');
    }

    if (!empty($available_workplace) and !empty($_POST) and empty($errors)) {
        $stmt = $pdo->prepare("
                             INSERT INTO wp_reservation (reservation_created, reservation_start, reservation_end, client_id, ws_id) 
                             VALUES (NOW(), ?, ?, ?, ?)                                           
                             ");

        $stmt->execute([
            $_POST['start'],
            $_POST['end'],
            $_POST['client'],
            $available_workplace['ws_id']
        ]);
        $success = true;
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
            <div class="success">You have successfully created a reservation</div>
        <?php endif; ?>
    </ul>

    <form method="POST">
        <div class="form-group">
            <?php if (isset($_SESSION['type']) && $_SESSION['type'] == 1) : ?>
                <label class="mr-sm-2" for="inlineFormCustomSelect">Select client:</label>
                <select name="client" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                    <?php
                    foreach ($available_clients as $client) { ?>
                        <option value="<?= $client['client_id'] ?>"><?= $client['name'] ?></option>
                    <?php
                    } ?>
                </select>
        </div>
        <div class="form-group">
            <label for="start">When would you like your reservation to start?</label>
            <input type="date" name="start" class="form-control" id="start" placeholder="2020-01-01">
        </div>
        <div class="form-group">
            <label for="end">When would you like your reservation to end?</label>
            <input type="date" name="end" class="form-control" id="end" placeholder="2020-01-01">
        </div>
    <?php elseif (isset($_SESSION['type']) && $_SESSION['type'] == 0) : ?>
        <div class="form-group">
            <label for="start">When would you like your reservation to start?</label>
            <input type="date" name="start" class="form-control" id="start" placeholder="2020-01-01">
        </div>
        <div class="form-group">
            <label for="end">When would you like your reservation to end?</label>
            <input type="date" name="end" class="form-control" id="end" placeholder="2020-01-01">
        </div>
    <?php endif; ?>
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
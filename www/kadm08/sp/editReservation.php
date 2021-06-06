<?php
session_start();

require __DIR__ . '/db.php';
require __DIR__ . '/user_required.php';

$success = false;

$errors = [];

if (!empty($_POST) and empty($errors)) {
    $statement = $pdo->prepare("UPDATE wp_reservation SET 
                            reservation_start = :start,
                            reservation_end = :end
                            WHERE reservation_id = :reservation_id;");
    $statement->execute([
        'reservation_id' => $_GET['reservation_id'],
        'start' => $_POST['start'],
        'end' => $_POST['end'],
    ]);

    $success = true;
}

$item = $pdo->prepare("SELECT * FROM wp_reservation WHERE reservation_id = :reservation_id;");
$item->execute(['reservation_id' => $_GET['reservation_id']]);
$item = $item->fetchAll()[0];


?>


<?php require __DIR__ . '/includes/header.php'; ?>
<main class="container">
    <br /><br /><br />
    <h1>Edit an item</h1>
    <ul>
        <?php foreach ($errors as $message) : ?>
            <div class="error"><?php echo  $message; ?></div>
        <?php endforeach; ?>
        <?php if ($success) : ?>
            <div class="success">You have successfully edited an item</div>
        <?php endif; ?>
    </ul>
    <form method="POST">
        <div class="form-group">
            <label for="id">ID</label>
            <input readonly class="form-control" id="id" name="id" value="<?= $item['reservation_id'] ?>" />
            <label for="start">Start</label>
            <input class="form-control" id="start" name="start" value="<?= $item['reservation_start'] ?>" />
            <label for="end">End</label>
            <input class="form-control" id="end" name="end" value="<?= $item['reservation_end'] ?>" />
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
    <div style="margin-bottom: 600px"></div>
</main>
<?php require __DIR__ . '/includes/footer.php'; ?>
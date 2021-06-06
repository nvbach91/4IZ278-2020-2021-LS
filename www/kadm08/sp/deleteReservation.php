<?php
session_start();

require __DIR__ . '/db.php';
require __DIR__ . '/adminRequired.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $success = false;
        $statement = $pdo->prepare("DELETE FROM wp_reservation WHERE reservation_id = :reservation_id;");
        $statement->execute(['reservation_id' => $_GET['reservation_id']]);
        $success = true;
 }

?>

<?php require __DIR__ . '/includes/header.php'; ?>
<br><br><br><br>
<main class="container">
    <?php if ($success) : ?>
        <div class="success">You have successfully deleted an item.</div>
    <?php else : ?>
        <div class="error"> <?php echo $errorMessage; ?>
        </div>
    <?php endif; ?>
    <div>
        <br>
        <a href="reservations.php" class="btn btn-primary">Go back to reservations</a>
    </div>
</main>
<?php require __DIR__ . '/includes/footer.php'; ?>
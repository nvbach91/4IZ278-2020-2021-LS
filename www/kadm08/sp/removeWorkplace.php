<?php
session_start();

require __DIR__ . '/db.php';
require __DIR__ . '/adminRequired.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $success = false;
    try {
        $statement = $pdo->prepare("DELETE FROM workplace WHERE ws_id = :ws_id;");
        $statement->execute(['ws_id' => $_POST['ws_id']]);
        $success = true;
    } catch (PDOException $e) {
        if ($e->errorInfo[1] == 1451) {
            $errorMessage = 'Cannot remove this worplace. There are active reservations for it.';
        }
    }
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
        <a href="workplaces.php" class="btn btn-primary">Go back to workplaces</a>
    </div>
</main>
<?php require __DIR__ . '/includes/footer.php'; ?>
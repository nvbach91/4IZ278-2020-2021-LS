<?php
session_start();

require __DIR__ . '/db.php';
require __DIR__ . '/adminRequired.php';
require_once __DIR__ . '/lib/WorkplaceDB.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $success = false;
    try {
        $workplaceDB = new WorkplaceDB();
        $workplace = $workplaceDB->deleteItem($_GET['ws_id']);
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
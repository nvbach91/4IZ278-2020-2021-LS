<?php
session_start();

require __DIR__ . '/db.php';
require __DIR__ . '/user_required.php';


$success = false;

$statement = $pdo->prepare("DELETE FROM workplace WHERE ws_id = :ws_id;");
$statement->execute(['ws_id' => $_GET['ws_id']]);
$success = true;


?>

<?php require __DIR__ . '/includes/header.php'; ?>
<br><br><br><br>
<main class="container">
<?php if ($success) : ?>
    <div class="success">You have successfully deleted an item.</div>
<?php endif; ?>
<div>
<br>
<a href="workplaces.php" class="btn btn-primary">Go back to workplaces</a>
</div>
</main>
<?php require __DIR__ . '/includes/footer.php'; ?>
<?php
require __DIR__ . '/db.php';
session_start();
$success = false;
$statement = $db->prepare("DELETE FROM goods WHERE id = :id;");
$statement->execute(['id' => $_GET['id']]);
$success = true;
?>

<?php require __DIR__ . '/incl/header.php'; ?>
<main class="container">
<?php if ($success) : ?>
    <div class="success">You have successfully deleted an item.</div>
<?php endif; ?>
</main>
<?php require __DIR__ . '/incl/footer.php'; ?>

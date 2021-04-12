<?php

require __DIR__ . '/db.php';

$success = false;

$statement = $pdo->prepare("DELETE FROM goods WHERE id = :id;");
$statement->execute(['id' => $_GET['id']]);
$success = true;


?>


<?php require __DIR__ . '/includes/header.php'; ?>
<main class="container">
<?php if ($success) : ?>
    <div class="success">You have successfully deleted an item.</div>
<?php endif; ?>
</main>
<?php require __DIR__ . '/includes/footer.php'; ?>
<?php

require __DIR__ . '/../utils/utils.php';

$users = findUsers();

?>

<?php require __DIR__ . '/../includes/header.php'; ?>

<main>
    <?php include __DIR__ . '/../includes/navigation.php'; ?>
    <h1>Users</h1>
    <?php foreach ($users as $user) : ?>
        <div class="user">
            <h2>User's name</h2>
            <p><?php echo $user['name']; ?></p>
            <h2>User's email</h2>
            <p><?php echo $user['email']; ?></p>
        </div>
    <?php endforeach; ?>
</main>

<?php require __DIR__ . '/../includes/footer.php'; ?>
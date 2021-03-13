<?php

require __DIR__ . '/utils/utils.php';

$email = $_GET['email'];
$user = findUser($email);

if (!$user) {
    header('Location: login.php');
    exit();
}

?>

<?php require __DIR__ . '/includes/header.php'; ?>

<main>
    <?php include __DIR__ . '/includes/navigation.php'; ?>
    <h1>Profile</h1>
    <div class="user">
        <h2>User's name</h2>
        <p><?php echo $user['name']; ?></p>
        <h2>User's email</h2>
        <p><?php echo $user['email']; ?></p>
    </div>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
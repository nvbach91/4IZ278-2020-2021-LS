<?php
$databaseFileName = '../database/users.db';

$userRecords = file($databaseFileName);
?>

<?php include '../includes/head.php'; ?>
<nav>
    <a href="../index.php">Homepage</a>
    <a href="../registration.php">Registration</a>
    <a href="../login.php">Login</a>
</nav>
<main>
    <h1>Users</h1>

    <ul>
        <?php foreach ($userRecords as $userRecord) : ?>
            <li>
                <div><?php echo $userRecord ?></div>
            </li>
        <?php endforeach ?>

    </ul>

</main>
<?php include '../includes/foot.php'; ?>
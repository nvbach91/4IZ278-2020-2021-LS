<?php
$row = isset($_GET['userRow']) ? $_GET['userRow'] : null;
$message = null;
if ($row !== null) {
    $databaseFileName = __DIR__ . '/database/users.db';
    $users = file($databaseFileName);
    $userRow = explode(';', $users[$row]);
    $message = 'Hello, ' . $userRow[0] . '!';
}
?>
<?php include __DIR__ . '/includes/head.php'; ?>
<?php include __DIR__ . '/includes/navigation.php'; ?>
<main>
    <h1>Homepage</h1>
    <p><?php echo $message;?></p>
</main>
<?php include __DIR__ . '/includes/foot.php'; ?>
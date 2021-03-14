<?php
$databaseFileName = './database/users.db';
$lines = file($databaseFileName);
$users = [];
foreach ($lines as $line) {
    if (!$line) {
        continue;
    }
    $fields = explode(';', $line);
    $user = [
        'name' => $fields[0],
        'email' => $fields[1],
        'password' => preg_replace('/\s+/', '', $fields[2]),
    ];
    array_push($users, $user);
}
?>
<?php include './includes/header.php' ?>
<?php include './includes/navigation.php' ?>
<main>
    <h1>Hello admin</h1>
    <h2>All users</h2>
    <br>
    <div class="container">
        <?php foreach ($users as $user) : ?>
            <div class="row">
                <div class="col-sm">
                    <h4><?php echo $user['name']; ?></h4>
                </div>
                <div class="col-sm">
                    <h5><?php echo $user['email']; ?></h5>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>
<?php include './includes/footer.php' ?>
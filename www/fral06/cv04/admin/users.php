<?php include __DIR__ . '/../includes/head.php'; ?>
<?php include __DIR__ . '/../includes/navigation.php'; ?>

<?php
function fetchUsers() {
    $dbFileName = __DIR__ . '/../database/users.db';
    $users = [];
    $lines = file($dbFileName);
    foreach ($lines as $line) {
        $line = trim($line);
        if (!$line) continue; // skip blank lines
        $fields = explode(';', $line);
        $users[$fields[1]] = [
            'name' => $fields[0],
            'email' => $fields[1],
        ];
    }
    return $users;
};

$users = fetchUsers();
?>

<main>
    <main class="container">
        <h1 class="text-center">Users</h1>
        <?php foreach ($users as $user): ?>
            <div class="card mb-3" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $user['name']; ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted"><?php echo $user['email'] ?></h6>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="mailto:<?php echo $user['email']; ?>" class="card-link">Send mail</a>
                    <a href="#" class="card-link">Github Account</a>
                </div>
            </div>
        <?php endforeach; ?>
</main>


<?php include __DIR__ . '/../includes/foot.php'; ?>

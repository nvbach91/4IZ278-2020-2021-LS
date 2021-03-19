<?php
// nacist data z db souboru
// proiterovat zaznamy z db v poli
// pro kazdy zaznam vypsat do HTML jmeno a email (ne heslo)
$databaseFileName = __DIR__ . '/database/users.db';
$lines = file($databaseFileName);
$data = [];
foreach ($lines as $line) {
    if (!$line) {
        continue;
    }
    $fields = explode(';', $line);
    $data[] = [
            'name' => $fields[0],
            'email' => $fields[1],
    ];
}
?>
<?php include __DIR__ . '/includes/head.php'; ?>
<?php include __DIR__ . '/includes/navigation.php'; ?>
<main>
    <h1>Users</h1>
        <?php foreach ($data as $user) {
            echo '<p>Name: ' . $user['name'] . ', email : ' . $user['email'] . '</p>';
        }?>
</main>
<?php include __DIR__ . '/includes/foot.php'; ?>
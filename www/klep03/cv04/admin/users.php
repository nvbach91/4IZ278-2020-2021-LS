<?php include __DIR__ . '/../includes/head.php' ?>
<?php include __DIR__ . '/../includes/navigation.php'; ?>

<?php
function fetchUsers()
{
    $databaseFileName = __DIR__ . '/../database/users.db';

    $userRecords = file($databaseFileName);

    $users = [];

    foreach ($userRecords as $userRecord) {
        if (!$userRecord) {
            continue;
        }
        $fields = explode(';', $userRecord);
        $user = [
            'name' => $fields[0],
            'email' => $fields[1],
            'password' => $fields[2],
        ];
        array_push($users, $user);
    }

    return $users;
};

?>

<main>
    <h1>Welcome</h1>
    <?php
    foreach (fetchUsers() as $user) {
        $email = $user['email'];
        $name = $user['name'];
        $password = $user['password'];
        echo "<p>Email: $email</p><br><p>Name: $name</p><br><p>Password: $password</p><br><br>";
    }
    ?>
</main>

<?php include __DIR__ . '/../includes/foot.php' ?>
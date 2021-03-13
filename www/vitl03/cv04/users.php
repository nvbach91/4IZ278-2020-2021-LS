<?php
function loadUsers()
{
    $databaseFileName = __DIR__ . '/database/user.db';

    $userRecords = file($databaseFileName);

    foreach ($userRecords as $userRecordLine) {
        $userRecord = substr($userRecordLine, 0, -1);

        $fields = explode(';', $userRecord);

        $user = [
            'name' => $fields[0],
            'email' => $fields[1],
            'password' => $fields[2],
        ];
        print ($user['name']) . "<br>";
    }
}
?>

<?php include __DIR__ . '/includes/header.php' ?>
<?php include __DIR__ . '/includes/navigation.php' ?>
<div class="container">
    <h1 class="row justify-content-center">Welcome</h1>
    <div class="row justify-content-center">
        <div class="row">
            <h1>Registered users: </h1>

        </div>
    </div>
    <div class="row justify-content-center">
        <h2><?php loadUsers(); ?></h2>
    </div>
</div>

<?php include __DIR__ . '/includes/footer.php' ?>
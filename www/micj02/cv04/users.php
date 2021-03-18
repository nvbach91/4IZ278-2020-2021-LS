<?php
$users = [];
$databaseFileName = __DIR__ . "/database/users.db";
$lines = file($databaseFileName);
foreach ($lines as $line) {
    if (!$lines) {
        continue;
    }
    $fields = explode(';', $line);
    array_push($users, $fields);
}
?>



<?php include 'include/header.php' ?>
<?php include __DIR__ . "/include/navigation.php"?>
    <main>
        <div class="row m-3"><h1>Users</h1></div>
        <div class="row m-3 w-50">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Row number</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $index => $value): ?>
                    <tr>
                        <th scope="row"><?php echo $index + 1 ?></th>
                        <td><?php echo $value[0] ?></td>
                        <td><?php echo $value[1] ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
<?php include 'include/footer.php' ?>
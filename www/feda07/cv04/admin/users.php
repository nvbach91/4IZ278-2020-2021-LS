<?php
$databaseFileName = __DIR__ . '/../database/users.db';
$userRecords = file($databaseFileName);

?>
<?php include __DIR__ . '/../includes/head.php'; ?>
    <main class="admin">
        <?php $userRecords = file($databaseFileName);
        foreach ($userRecords as $userRecord):  ?>
       <p> <?php {
               $fields = explode(';', $userRecord);
               $user = [
                   'name' => $fields[0],
                   'email' => $fields[1],
                   'password' => $fields[2],
               ];
               echo 'Name: ' . $user['name'] . ';' . " " . ' username: ' . $user['email'] . "\n";
           }
?>
           <?php endforeach; ?>
    </main>
<?php include __DIR__ . '/../includes/foot.php'; ?>
<?php 
$databaseFileName = __DIR__ . '/database/users.db';
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

<?php include __DIR__ . '/includes/header.php'; ?>
<?php include __DIR__ . '/includes/navigation.php'; ?>
<main>
    <h1>All users</h1>

    <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
    </tr>
  </thead>
  <tbody>
  <?php  $i=1; foreach ($users as $user): ?>
    <tr>
        <th scope="row"><?php echo $i ?></th>
        <td><?php echo $user['name']?></td>
        <td><?php echo $user['email']; $i++?></td>
    </tr>
    <?php endforeach?>
  </tbody>
</table>
</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
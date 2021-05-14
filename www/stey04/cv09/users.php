<?php
require "config.php";
$stmt = $pdo->prepare('SELECT * FROM users');
$stmt->execute();
$users = @$stmt->fetchAll();
?>

<?php include __DIR__ . '/includes/header.php' ?>
<?php include __DIR__ . '/includes/nav.php' ?>
<h1>Users</h1>
<table class="table">
    <tr>
        <th>id</th>
        <th>privilege</th>
        <th>Email</th>
        <th>Password</th>
    </tr>
    <?php
    foreach ($users as $r) {
        echo "<tr>";
        $id = $r['id'];
        $p = $r['privilege'];
        $email = $r['email'];
        $password = $r['password'];
        echo "<td>$id</td>";
        echo "<td>$p</td>";
        echo "<td>$email</td>";
        echo "<td>$password</td>";
        echo "</tr>";
    }
    ?>
</table>

<?php include __DIR__ . '/includes/footer.php' ?>
<?php
require "../utils/database.php";
$users = fetchUsers();
?>
<?php include "../utils/header.php"; ?>
<h1>Seznam uživatelů</h1>
<table>
    <?php foreach ($users as $user): ?>
    <tr>
        <td><?php echo $user['username'] ?></td>
        <td><?php echo $user['email'] ?></td>
    </tr>
    <?php endforeach; ?>
</table>

<?php include "../utils/footer.php"; ?>
<?php require_once __DIR__ . '/../db/UsersDB.php'; ?>

<?php
session_start();
if ($_SESSION['admin'] != 3) {
    header('Location: /./~vonm10/beardwithme/index.php');
    http_response_code(403);
    die();
}

$usersDB = new UsersDB();
$userRecords = $usersDB->fetchAll();

if (!empty($_POST)) {
    $usersDB->updateRole($_POST['button'], $_POST['newRole']);
    header("Refresh:0");
}

?>




<?php require __DIR__ . '/../incl/header.php'; ?>
<h1>Users</h1>
<table border="1">
    <tr>
        <th>id</th>
        <th>email</th>
        <th>password</th>
        <th>role</th>
        <th>new role</th>
        <th>confirm</th>
    </tr>
    <?php foreach ($userRecords as $userRecord) : ?>
        <form method="POST">
            <tr>
                <td><?php echo $userRecord['id'] ?></td>
                <td><?php echo $userRecord['email'] ?></td>
                <td><?php echo $userRecord['password'] ?></td>
                <td><?php echo $userRecord['admin'] ?></td>
                <td>
                    <select name="newRole">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                </td>
                <td><button name="button" value=<?php echo $userRecord['id'] ?>>Confirm</button></td>
            </tr>
        </form>
    <?php endforeach ?>
</table>
<?php require __DIR__ . '/../incl/footer.php'; ?>
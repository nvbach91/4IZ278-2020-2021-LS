<?php require __DIR__ . '/isUser.php'; ?>
<?php
$msg = '';
$msgClass = '';

$pdo = new PDO(
    "mysql:host=localhost;dbname=vitl03;charset=utf8mb4",
    "vitl03",
    "eigheeLae4Aith9aiH"
);
if ((int) $current_user['privillage'] < 3) {

    exit('Unauthorized');
}

if ((!empty($_POST))) {
    foreach ($_POST as  $key => $value) {
        $statement = $pdo->prepare('UPDATE users SET privillage=? WHERE id=?');
        $statement->execute(array($value, $key));
        $msg = "Privillages were changed";
        $msgClass = 'alert-success';
    }
}

$statement = $pdo->prepare('SELECT * FROM users');
$statement->execute();

$users = $statement->fetchAll();

?>

<?php include __DIR__ . '/includes/header.php' ?>
<?php require __DIR__ . '/includes/navigation.php'; ?>

<body>
    <div class="container">

        <br>
        <h1>Users</h1>
        <?php if ($msg != '') : ?>
            <div class="alert <?php echo $msgClass; ?>"><?php echo $msg; ?></div>
        <?php endif; ?>
        <form action="users.php" method="POST" name="theForm" id="theForm">
            <div class="products">
                <div class="users">
                    <table>

                        <tr>
                            <th>Email</th>
                            <th>Privillage</th>
                        </tr>
                        <?php foreach ($users as $user) : ?>
                            <tr>
                                <td>
                                    <a><?php echo $user['email']; ?></a>
                                </td>
                                <td>
                                    <select form="theForm" name="<?php echo $user['id'] ?>">
                                        <option value="1" <?php echo $user['privillage'] == '1' ? ' selected' : '' ?>>User</option>
                                        <option value="2" <?php echo $user['privillage'] == '2' ? ' selected' : '' ?>>Manager</option>
                                        <option value="3" <?php echo $user['privillage'] == '3' ? ' selected' : '' ?>>Admin</option>
                                    </select>
                                </td>
                            </tr>

                        <?php endforeach; ?>
                    </table>

                </div>
            </div>
            <button class="btn btn-lg btn-warning btn-block text-uppercase" type="submit">Submit changes</button>
        </form>
        <br>
        <div style="margin-bottom: 600px"></div>
    </div>

    <?php include __DIR__ . '/includes/footer.php' ?>
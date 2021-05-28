<?php require_once __DIR__ . '/class/UsersDB.php'; ?>
<?php require __DIR__ . '/isUser.php'; ?>

<?php
$msg = '';
$msgClass = '';

if ((int) $current_user['privilege'] < 3) {

    exit('Unauthorized');
}

$usersDB = new UsersDB();

if ((!empty($_POST))) {
    foreach ($_POST as  $key => $value) {

        $usersDB->update($value, $key);

        $msg = "Privileges were changed";
        $msgClass = 'alert-success';
    }
}

$users = $usersDB->fetchAll();

?>
<?php include __DIR__ . '/includes/header.php' ?>


<body>
    <div class="container">
        <br>
        <a href="index.php?page=admin"><button style="margin-bottom:20px;" class="primary-btn">Back to Admin Panel</button></a>

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
                            <th>Privilege</th>
                        </tr>
                        <?php foreach ($users as $user) : ?>
                            <tr>
                                <td style="padding:5px;">
                                    <a><?php echo $user['email']; ?></a>
                                </td>
                                <td>
                                    <select form="theForm" name="<?php echo $user['id'] ?>">
                                        <option value="1" <?php echo $user['privilege'] == '1' ? ' selected' : '' ?>>User</option>
                                        <option value="2" <?php echo $user['privilege'] == '2' ? ' selected' : '' ?>>Manager</option>
                                        <option value="3" <?php echo $user['privilege'] == '3' ? ' selected' : '' ?>>Admin</option>
                                    </select>
                                </td>
                            </tr>

                        <?php endforeach; ?>
                    </table>

                </div>
            </div>
            <br>
            <button class="button-red" type="submit">Submit changes</button>
        </form>
        <br>
        <div style="margin-bottom: 300px"></div>
    </div>


    <?php include __DIR__ . '/includes/newsletter.php' ?>

    <?php include __DIR__ . '/includes/footer.php' ?>
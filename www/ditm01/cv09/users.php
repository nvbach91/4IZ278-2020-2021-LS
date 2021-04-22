<?php require __DIR__ . '/database_connection.php';?>
<?php require __DIR__ . '/user_required.php';?>
<?php
if ((int)$current_user['privileges'] < 3) {
    exit('Unauthorized');
}

if(!empty($_POST)){
    foreach ($_POST as  $key => $value){
        $statement = $pdo->prepare("UPDATE users SET privileges=? WHERE id=?");
        $statement->execute(array( $value, $key));
    }
}

$statement = $pdo->prepare('SELECT * FROM users');
$statement->execute();
$users = $statement->fetchAll();
?>

<?php include __DIR__ . '/includes/header.php'; ?>
<main class="container">
    <h1>Users</h1>
    <form action="users.php" method="POST" name="theForm" id="theForm">
    <div class="products">
        <div class="users">
            <div>Email</div>
            <div></div>
            <div>Privileges</div>
        </div>
        <?php foreach ($users as $user): ?>
            <div class="users">
                <div><a><?php echo $user['email'];?></a></div>
                <div></div>
                    <div>
                        <select form="theForm" name="<?php echo $user['id'] ?>">
                            <option value="1" <?php echo $user['privileges'] == '1' ? ' selected' : '' ?>>User</option>
                            <option value="2" <?php echo $user['privileges'] == '2' ? ' selected' : '' ?>>Manager</option>
                            <option value="3" <?php echo $user['privileges'] == '3' ? ' selected' : '' ?>>Admin</option>
                        </select>
                    </div>
            </div>
        <?php endforeach; ?>
    </div>
        <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Submit changes</button>
    </form>
    <br>
</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
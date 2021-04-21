<?php
    require __DIR__ . '/admin-required.php';
    require __DIR__ . '/includes/header.php';
    require __DIR__ . '/db.php';

    if (!empty($_POST)) {
        foreach($_POST as $id=>$role) {
            $update = "UPDATE users SET role=:role WHERE id = :id";
            $stmt = $pdo->prepare($update);
            $stmt->bindValue(':id', $id);
            $stmt->bindValue(':role', $role);
            $update_result = $stmt->execute();
            if(!$update_result) {
                $message = ["text" => "Update was not successful!", "success" => false];
                exit();
            }
        }

        $message = ["text" => "User roles were correctly updated.", "success" => true];
    }

    $sql = "SELECT * FROM users WHERE 1";
    $stmt = $pdo->prepare($sql);
    $result = $stmt->execute();
    if (!$result){
        exit("Something went wrong. Cannot get users!");
    }
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<main class="container">
    <h1 class="text-center">Change users' roles</h1>
    <?php if(isset($message)): ?>
        <div class="alert <?php echo $message['success'] ? ' alert-success' : ' alert-danger'; ?>">
            <?php echo $message['text']; ?>
            <p class="text-center">
                <a href="index.php?offset=<?php echo $offset?>">
                    <i class="mr-2 fas fa-arrow-left"></i>Go Back
                </a>
            </p>
        </div>
    <?php endif; ?>
    <form class="users-form" method="POST">
        <?php foreach($users as $key=>$user): ?>
            <div class="row justify-content-between mb-2">
                <span><?php echo $key; ?></span>
                <span><?php echo $user['email']; ?></span>
                <input type="hidden" value="<?php echo count($users); ?>">
                <select name="<?php echo $user['id'];?>" id="roles">
                    <option <?php echo isset($user) && $user['role'] == 0 ? 'selected' : '' ;?> value="0">Normal</option>
                    <option <?php echo isset($user) && $user['role'] == 1 ? 'selected' : '' ;?> value="1">Manager</option>
                    <option <?php echo isset($user) && $user['role'] == 2 ? 'selected' : '' ;?> value="2">Admin</option>
                </select>
            </div>
        <?php endforeach; ?>
        <button class="btn btn-primary" type="submit">Save changes</button>
    </form>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
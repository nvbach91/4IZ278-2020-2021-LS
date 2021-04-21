<?php
    require __DIR__ . '/admin-required.php';
    require __DIR__ . '/includes/header.php';
    require __DIR__ . '/config/config.php';

    if (!empty($_POST)) {
        foreach($_POST as $user_id=>$privilege) {
            $update = "UPDATE users SET privilege=:privilege WHERE user_id = :user_id";
            $stmt = $connect->prepare($update);
            $stmt->bindValue(':user_id', $user_id);
            $stmt->bindValue(':privilege', $privilege);
            $update_result = $stmt->execute();
            if(!$update_result) {
                $message = ["text" => "Update was not successful!", "success" => false];
                exit();
            }
        }

        $message = ["text" => "User roles were correctly updated.", "success" => true];
    }

    $sql = "SELECT * FROM users WHERE 1";
    $stmt = $connect->prepare($sql);
    $result = $stmt->execute();
    if (!$result){
        exit("Something went wrong. Cannot get users!");
    }
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<main class="container">
    <h1 class="text-center">Change users roles</h1>
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
    <form class="form" method="POST">
        <?php foreach($users as $key=>$user): ?>
            <div class="form-group">
                <span><?php echo $key; ?></span>
                <span class="text-primary"><?php echo $user['email']; ?></span>
                <input type="hidden" value="<?php echo count($users); ?>">
                <select name="<?php echo $user['user_id'];?>" id="roles">
                    <option <?php echo isset($user) && $user['privilege'] == 0 ? 'selected' : '' ;?> value="0">Normal</option>
                    <option <?php echo isset($user) && $user['privilege'] == 1 ? 'selected' : '' ;?> value="1">Manager</option>
                    <option <?php echo isset($user) && $user['privilege'] == 2 ? 'selected' : '' ;?> value="2">Admin</option>
                </select>
            </div>
        <?php endforeach; ?>
        <button class="btn btn-primary" type="submit">Save changes</button>
    </form>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
<?php
    require_once __DIR__ . '/config/config.php';
    require __DIR__ . '/admin-required.php';

    include __DIR__ . '/partials/header.php';
    include __DIR__ . '/navigation.php';

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
        </div>
    <?php endif; ?>
    <form class="form" method="POST">
        <?php foreach($users as $key=>$user): ?>
            <?php if($user['email'] !== $_SESSION['user_email']): ?>
            <div class="form-group">
                <span><?php echo $key; ?></span>
                <span class="text-primary"><?php echo $user['email']; ?></span>
                <input type="hidden" value="<?php echo count($users); ?>">
                <select name="<?php echo $user['user_id'];?>" id="roles">
                    <option <?php echo isset($user) && $user['privilege'] == 0 ? 'selected' : '' ;?> value="0">Normal</option>
                    <option <?php echo isset($user) && $user['privilege'] == 1 ? 'selected' : '' ;?> value="1">Admin</option>
                </select>
            </div>
            <?php endif ?>
        <?php endforeach; ?>
        <button class="btn btn-primary" type="submit">Save changes</button>
    </form>
</main>

<?php
include __DIR__ . '/partials/footer.php';
?>
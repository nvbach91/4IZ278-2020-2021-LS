<?php

session_start();

require __DIR__ . '/db.php';

$errorMessages = [];

if (isset($_SESSION['user_privilege']) && $_SESSION['user_privilege'] != 3) {
    array_push($errorMessages, "ou do not have permission to view this.");
    exit();
}

if ($_POST) {
    $update = $pdo->prepare('
      UPDATE users SET
      privilege = :privilege
      WHERE id = :id;
    ');
    $update->execute([
        'privilege' => $_POST['privilege'],
        'id' => $_POST['id']
    ]);
}

$users = $pdo->prepare('
  SELECT id, email, privilege FROM users ORDER BY privilege desc;
  ');
$users->execute();
$users = $users->fetchAll(PDO::FETCH_UNIQUE | PDO::FETCH_ASSOC);

?>

<?php include __DIR__ . '/includes/header.php'; ?>

<h1 style="text-align: center;">Users</h1>

<?php foreach ($users as $id => $user) : ?>

    <div class="container">
        <form action="users.php" method="POST">
            <div class="row">
                <div class="col-sm">
                    <input name="id" type="text" value="<?= $id ?>">
                </div>
                <div class="col-sm">
                    <?= $user['email'] ?>
                </div>
                <div class="col-sm">
                    <input name="privilege" type="number" min="1" max="3" value="<?= $user['privilege'] ?>">
                </div>
                <div class="col-sm">
                    <button type="submit" class="btn btn-primary">Change</button>
                </div>
            </div>
        </form>
    </div>

<?php endforeach; ?>


<?php include __DIR__ . '/includes/footer.php'; ?>
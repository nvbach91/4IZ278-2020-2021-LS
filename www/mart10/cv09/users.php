
<?php
require 'db.php';
session_start();

if (@$_SESSION['user_privilege'] < 3) {
  header('Location: index.php');
  die();
}

if (@$_POST) {
  $update = $db->prepare('
    UPDATE users SET
    privilege = :privilege
    WHERE id = :id;
  ');
  $update->execute([
    'privilege' => $_POST['privilege'],
    'id' => $_POST['id']
  ]);
}

$users = $db->prepare('
SELECT id, email, privilege FROM users ORDER BY privilege desc;
');
$users->execute();
$users = $users->fetchAll(PDO::FETCH_UNIQUE|PDO::FETCH_ASSOC);

?>
<?php require './incl/header.php'; ?>
<h1 style="text-align: center;">Users</h1>
<?php foreach($users as $id => $user): ?>
   <main class="container">
    <form action="users.php" method="POST">
      <div class="row">
        <div class="col-sm">
          <span>ID: </span><input name="id" type="text" value="<?= $id ?>">
        </div>
        <div class="col-sm">
        <span>Email: </span><?= $user['email'] ?>
        </div>
        <div class="col-sm">
        <span>Privilege: </span><input name="privilege" type="number" min="1" max="3" value="<?= $user['privilege'] ?>">
        </div>
        <div class="col-sm">
          <button type="submit" class="btn btn-danger">Change</button>
        </div>
      </div>
    </form>
   </main>
<?php endforeach; ?>
<?php require './incl/footer.php'; ?>
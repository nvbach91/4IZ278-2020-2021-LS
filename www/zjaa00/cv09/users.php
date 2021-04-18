<?php
  require "./partials/header.php";

  if (@$_SESSION['user_privilege'] < 3) {
    header('Location: logout.php');
    die();
  }

  if (@$_POST) {
    $update = $connect->prepare('
      UPDATE users SET
      privilege = :privilege
      WHERE id = :id;
    ');
    $update->execute([
      'privilege' => $_POST['privilege'],
      'id' => $_POST['id']
    ]);
  }
  
  $users = $connect->prepare('
  SELECT id, email, privilege FROM users ORDER BY privilege desc;
  ');
  $users->execute();
  $users = $users->fetchAll(PDO::FETCH_UNIQUE|PDO::FETCH_ASSOC);
  
  ?>

<h1 style="text-align: center;">Users</h1>

<?php foreach($users as $id => $user): ?>

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
          <button type="submit" class="btn btn-danger">Change</button>
        </div>
      </div>
    </form>
  </div>

<?php endforeach; ?>
  

<?php require "./partials/footer.php"; ?>
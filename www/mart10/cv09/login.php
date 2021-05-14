<?php
require __DIR__ . '/db.php';
session_start();
if(!empty($_POST)) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $login = $db->prepare('SELECT * FROM users WHERE email = :email');
    $login->execute([
        'email' => $email
    ]);
    @$user = $login->fetchAll()[0];

    if(password_verify($password, $user['password'])) {
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['user_email'] = $user['email'];
      $_SESSION['user_privilege'] = (int) $user['privilege'];

      header('Location: index.php');
      echo '<button type="button" class="btn btn-success" disabled>You are now signed in.</button>';
    } else {
      echo '<button type="button" class="btn btn-danger" disabled>You are not signed in.</button>';
    }
}

?>


<?php require './incl/header.php'; ?>
    <h2>Login</h2>
    <form method="POST">
        <label>E-mail</label>
        <input class="form-control" id="email" name="email" placeholder="Enter your email address">
        <label>Password</label>
        <input class="form-control" id="password" name="password" placeholder="Enter your password">
        <button type="submit">Login</button>
    </form> 
    <?php require './incl/footer.php'; ?>
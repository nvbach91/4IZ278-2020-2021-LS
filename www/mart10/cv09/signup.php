<?php 
require __DIR__ . '/db.php';
session_start();
// check if form is submitted
$submittedForm = !empty($_POST);
if ($submittedForm) {
    $email = htmlspecialchars($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $signup = $db->prepare("
      INSERT INTO users (email, password)
      VALUES (:email, :password);
    ");
    $signup->execute([
      "email" => $email,
      "password" => $password
    ]);

    header('Location: login.php');

}

?>


<?php require './incl/header.php'; ?>
    <h2>Signup</h2>
    <form method="POST">
        <label>E-mail</label>
        <input class="form-control" id="email" name="email" placeholder="Enter your e-mail address">
        <label>Password</label>
        <input class="form-control" id="password" name="password" type="password"  placeholder="Enter your password">
        <label>Confirm password</label>
        <input class="form-control" id="confirm" name="confirm" type="password" placeholder="Enter your password again">
        <button type="submit">Signup</button>
    </form>
<?php require './incl/footer.php'; ?>
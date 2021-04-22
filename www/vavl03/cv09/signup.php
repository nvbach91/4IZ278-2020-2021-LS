<?php
session_start();
require 'db.php';
$invalidInputs = [];
if ('POST' == $_SERVER['REQUEST_METHOD']) {
    $email = htmlspecialchars(trim(($_POST['email'])));
    $password = htmlspecialchars(trim(($_POST['password'])));

    if (!$email) {
        //chyba
        array_push($invalidInputs, 'Není zadaný email');
    }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($invalidInputs,'Email není validní');
    }
    if (!$password) {
        //chyba
        array_push($invalidInputs, 'Není zadané heslo');
    }else if (strlen($password) <6  ) {
        array_push($invalidInputs, 'Heslo je příliš krátké');
    }
    if(!is_null($invalidInputs)){
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $db->prepare('INSERT INTO users(email, password, privileges) VALUES (:email, :password, 1)');
        $stmt->execute([
            'email' => $email,
            'password' => $hashedPassword
        ]);

        $stmt = $db->prepare('SELECT id FROM users WHERE email = :email LIMIT 1'); //limit 1 jen jako vykonnostni optimalizace, 2 stejne maily se v db nepotkaji
        $stmt->execute([
            'email' => $email
        ]);
        $user_id = (int) $stmt->fetchColumn();

        $_SESSION['user_id'] = $user_id;
        $_SESSION['user_email'] = $email;

        header('Location: index.php');
    }
      

}
?>


<?php require __DIR__ . '/incl/header.php' ?>
<main class="container">
    <h1>PHP Shopping App</h1>
    <h2>New Signup</h2>
    <ul >
        <?php foreach($invalidInputs as $msg):?>
            <div><strong class="error"><?php echo  $msg."<br>";?></strong></div>
        <?php endforeach; ?>
    </ul>
    <form class="form-signin" method="POST">
        <div class="form-label-group">
            <label for="email">Email address</label>
            <input type="email" name="email" class="form-control" placeholder="Email address" required autofocus>
        </div>
        <div class="form-label-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>
        <br>
        <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Create account</button>
    </form>
</main>
<div style="margin-bottom: 600px"></div>
<?php require __DIR__ . '/incl/footer.php' ?>
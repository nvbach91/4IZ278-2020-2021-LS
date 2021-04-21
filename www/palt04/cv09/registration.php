<?php
require __DIR__ . '/includes/header.php';
session_start();

if ('POST' == $_SERVER['REQUEST_METHOD']) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $exists = $connect->prepare('SELECT * FROM users WHERE email = :email LIMIT 1');
    // $exists->execute(array('email' => $email, 'pass' => $password));
    // $exists = $exists->fetchColumn();

    $exists->execute([
      'email' => $email
    ]);

    $existing_user = @$exists->fetchAll()[0];

    if ($existing_user) {
        echo "<div style='padding: 10px; background: firebrick; color: white; border-radius: 10px;' class='alert success'>Already used email</div>";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    //vlozime usera do databaze
    $stmt = $connect->prepare('INSERT INTO users(email, password) VALUES (:email, :password)');
    $stmt->execute([
        'email' => $email, 
        'password' => $hashedPassword
    ]);

    //ted je uzivatel ulozen, bud muzeme vzit id posledniho zaznamu pres last insert id (co kdyz se to potka s vice requesty = nebezpecne),
    // nebo nacist uzivatele podle mailove adresy (ok, bezpecne)

    $stmt = $connect->prepare('SELECT user_id FROM users WHERE email = :email LIMIT 1'); //limit 1 jen jako vykonnostni optimalizace, 2 stejne maily se v db nepotkaji
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

    <h1>PHP Shopping App</h1>
    <h2>New Signup</h2>
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
        <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Creat account</button>
    </form>
<div style="margin-bottom: 600px"></div>
<?php require __DIR__ . '/includes/footer.php' ?>
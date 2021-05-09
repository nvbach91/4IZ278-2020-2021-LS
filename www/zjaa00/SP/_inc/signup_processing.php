<?php

  if (!empty($_POST)) :
    $email = htmlspecialchars(trim($_POST['email']));
    $password = trim($_POST['password']);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $exists = $connect->prepare('
      SELECT * FROM users
      WHERE email = :email
      LIMIT 1;
    ');
    $exists->execute(['email' => $email]);
    @$user = $exists->fetchAll();
    
    $conditions = [
      "Email je neplatný"
      => filter_var($email, FILTER_VALIDATE_EMAIL),
      "Tento e-mail je už registrovaný"
      => (boolean) !$user,

      "Minimálny počet znakov v hesle je 6"
      => strlen($password) >= 6
    ];

    $validity = count(array_filter($conditions));
    if ($validity == count($conditions)) {

      $add = $connect->prepare("INSERT INTO users (email, password) VALUES (:email, :password);");
      $add->execute([
        'email' => $email,
        'password' => $hashed_password
      ]);

      $minutesOfLogin = 60*24; //in minutes
      setcookie('email', $email, time() + $minutesOfLogin*60);
      setcookie('privilege', 1, time() + $minutesOfLogin*60);
      
      mail(
        $email,
        "Congrats",
        "Congrats! You finally did it. You signed up!"
      );

      header("Location: index.php");
    }

    foreach ($conditions as $error_message => $condition) :
      if (!$condition) :
?>

      <div class="alert danger"><?= $error_message ?></div>

<?php

      endif;
    endforeach;
  endif;
?>
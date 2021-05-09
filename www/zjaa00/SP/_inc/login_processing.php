<?php

if (!empty($_POST)) :
  $email = trim($_POST['email']);
  $password = trim($_POST['password']);

  $exists = $connect->prepare('
    SELECT * FROM users
    WHERE email = :email
    LIMIT 1;
  ');
  $exists->execute(['email' => $email]);
  @$user = $exists->fetchAll()[0];
  
  $conditions = [
    "Email je neplatný"
    => filter_var($email, FILTER_VALIDATE_EMAIL),

    "Užívateľ s týmto prihlasovacím menom a heslom neexistuje"
    => ($user && password_verify($password, $user['password'])),

    "Minimálny počet znakov v hesle je 6"
    => strlen($password) >= 6
  ];

  $validity = count(array_filter($conditions));
  if ($validity == count($conditions)) {

    $minutesOfLogin = 60*24; //in minutes
    setcookie('email', $user['email'], time() + $minutesOfLogin*60);
    setcookie('privilege', $user['privilege'], time() + $minutesOfLogin*60);
    
    header('Location: index.php');
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
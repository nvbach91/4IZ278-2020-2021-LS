<?php

if (!empty($_POST)):
  $email = trim($_POST['email']);
  $password = trim($_POST['password']);

  //skontrolujeme, či sa daný užívateľ nachádza v databáze
  $select = $connect->prepare('
    SELECT * FROM users
    WHERE email = :email
    LIMIT 1;
  ');
  $select->execute(['email' => $email]);
  @$user = $select->fetchAll()[0];
  
  $conditions = [
    "Email je neplatný"
    => filter_var($email, FILTER_VALIDATE_EMAIL),

    "Užívateľ s týmto prihlasovacím menom a heslom neexistuje"
    => ($user && password_verify($password, $user['password'])),

    "Minimálny počet znakov v hesle je 6"
    => strlen($password) >= 6
  ];

  //vytvoríme array s podmienkami v $conditions, ktoré mali hodnotu TRUE a zrátame ich
  $true_conditions = count(array_filter($conditions));

  //ak sa počet všetkých podmienok ($conditions) rovná tým, ktoré mali hodnotu TRUE ($true_conditions), tak prebehlo prihlásenie úspešne
  if ($true_conditions == count($conditions)) {
    $minutesOfLogin = 60*12; //v minútach
    setcookie('email', $user['email'], time() + $minutesOfLogin*60);
    setcookie('privilege', $user['privilege'], time() + $minutesOfLogin*60);
    
    header('Location: index.php');
  }
    
    //pokiaľ prihlásenie neprebehlo úspešne, tak vypíšeme všetky chybové hlášky
    foreach ($conditions as $error_message => $condition) :
      if (!$condition):
?>

      <div class="alert danger"><?= $error_message ?></div>

<?php

    endif;
  endforeach;
endif;
?>
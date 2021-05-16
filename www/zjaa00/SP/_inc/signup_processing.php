<?php

  if (!empty($_POST)) :
    $email = htmlspecialchars(trim($_POST['email']));
    $password = trim($_POST['password']);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    //skontrolujeme, či sa daný užívateľ už nachádza v databáze
    $select = $connect->prepare('
      SELECT * FROM users
      WHERE email = :email
      LIMIT 1;
    ');
    $select->execute(['email' => $email]);
    @$user = $select->fetchAll();
    
    $conditions = [
      "Email je neplatný"
      => filter_var($email, FILTER_VALIDATE_EMAIL),
      "Tento e-mail je už registrovaný"
      => (boolean) !$user,

      "Minimálny počet znakov v hesle je 6"
      => strlen($password) >= 6
    ];

    //vytvoríme array s podmienkami v $conditions, ktoré mali hodnotu TRUE a zrátame ich
    $true_conditions = count(array_filter($conditions));

    //ak sa počet všetkých podmienok ($conditions) rovná tým, ktoré mali hodnotu TRUE ($true_conditions), tak prebehla registrácia úspešne
    if ($true_conditions == count($conditions)) {

      $insert = $connect->prepare("INSERT INTO users (email, password) VALUES (:email, :password);");
      $insert->execute([
        'email' => $email,
        'password' => $hashed_password
      ]);

      $minutesOfLogin = 60*12; //v minútach
      setcookie('email', $email, time() + $minutesOfLogin*60);
      setcookie('privilege', 1, time() + $minutesOfLogin*60);
      
      mail(
        $email,
        "Congrats",
        "Congrats! You finally did it. You signed up!"
      );

      header("Location: index.php");
    }

    //pokiaľ registrácia neprebehla úspešne, tak vypíšeme všetky chybové hlášky
    foreach ($conditions as $error_message => $condition) :
      if (!$condition) :
?>

      <div class="alert danger"><?= $error_message ?></div>

<?php

      endif;
    endforeach;
  endif;
?>
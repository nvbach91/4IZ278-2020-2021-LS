<?php
  require "_inc/functions.php";

if (!empty($_GET)) {
  $email = str_replace(array(' ', "\n", "\t", "\r"), '', $_GET['email']);
}

if (!empty($_POST)) :
  $email = str_replace(array(' ', "\n", "\t", "\r"), '', $_POST['email']);
  $name = getUser($email)["name"];
  $password = str_replace(array(' ', "\n", "\t", "\r"), '', $_POST['password']);
  $correct_password = getUser($email)["password"];

  $conditions = [
    "You left some inputs blank"
    => (!empty($email) && !empty($password)),
    "Wrong username or password"
    => (getUser($email) && ($password == $correct_password))
  ];

  $validity = count(array_filter($conditions));
  if ($validity === count($conditions)) :

    header("Location: profile.php?name=$name&email=$email");

  endif;

    foreach ($conditions as $error_message => $condition) :
      if (!$condition) :
  ?>
  
        <div class="alert danger"><?= $error_message ?></div>
  
  <?php
      endif;
    endforeach;
  endif;

  ?>
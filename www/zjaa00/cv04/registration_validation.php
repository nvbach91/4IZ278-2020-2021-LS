<?php
  require "_inc/functions.php";

  if (!empty($_POST)) :
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];
  
    $conditions = [
      "Fill out your name"
      => !empty($name),
      "Your e-mail is invalid"
      => filter_var($email, FILTER_VALIDATE_EMAIL),
      "Passwords dont match"
      => $password === $confirm,
      "User already exists"
      => !(getUser($email) && $email !== ""),
      "Use at least 8 characters in your password"
      => strlen($password) >= 8
    ];
  
    $validity = count(array_filter($conditions));
    if ($validity == count($conditions)) :
    
      makeRegistration($_POST);
      
      sendEmail($email, 'My Awesome App: Registration was a success', "Hello, thank you for your registration, ...");

      header("Location: login.php?email=$email");
      
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
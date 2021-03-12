<?php

if (!empty($_POST)) :
  $name = $_POST['name'];
  $gender = $_POST['gender'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $avatar = $_POST['avatar'];
  $game = $_POST['game'];
  $cards = $_POST['cards'];

  $conditions = [
    "Fill out your name"
    => !empty($name),
    "Choose gender which describes you the closest"
    => !empty($gender),
    "Your e-mail is invalid"
    => filter_var($email, FILTER_VALIDATE_EMAIL),
    "Your phone number doesn't match the pattern of the examples below"
    => preg_match("/^\+?\d{12}$|^\d{10}$/", $phone),
    "Your avatar URL is invalid"
    => filter_var($avatar, FILTER_VALIDATE_URL),
    "Fill out the game name"
    => !empty($game),

    "Fill out the number of cards"
    => !empty($cards) || $cards == "0",
    "Number of cards has to be a digit"
    => is_numeric($cards) || $cards == "0",
    "The number of cards has to be higher than zero"
    => (!empty($cards) && $cards != "0"),
    "The number of cards has to be even"
    => (is_numeric($cards) ? ((int)$cards % 2 == 0) : false)
  ];

  $validity = count(array_filter($conditions));
  if ($validity == count($conditions)) :
?>

    <div class="alert success">Congrats! You finally did it. You signed up!</div>

<?php
    mail(
      $email,
      "Congrats",
      "Congrats! You finally did it. You signed up!"
    );  
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
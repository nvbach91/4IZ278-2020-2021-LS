<?php
session_start();

if (isset($_SESSION['email']) && !isset($_COOKIE['privilege'])) {
  
  $minutesOfLogin = 60*12; //v minútach
  setcookie('email', $_SESSION['email'], time() + $minutesOfLogin*60);
  setcookie('privilege', 1, time() + $minutesOfLogin*60);
  
  session_unset();
  session_destroy();
  session_write_close();
  session_regenerate_id(true);
  
  header('Location: index.php');
  die(); 
}

require "./partials/header.php";
require "./partials/homepage/navbar.php";

?>
<main id="drinks_page">

  <div id="drinks_box" style="display: none;">

  <!-- AJAX pre drinky zo súboru load_drinks.php -->

  </div>

</main>

<?php require "./partials/footer.php"; ?>
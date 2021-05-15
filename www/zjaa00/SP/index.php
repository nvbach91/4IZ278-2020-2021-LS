<?php
  require "./_inc/composer/vendor/autoload.php";
  require_once './_inc/config.php';
  
  if (isset($_GET['access_token'])) {
    $fb = new \Facebook\Facebook([
      'app_id' => APP_ID,
      'app_secret' => APP_SECRET,
      'default_graph_version' => 'v2.10',
      'default_access_token' => $_GET['access_token'],
    ]);

    $me = $fb->get('/me?fields=email')->getGraphUser();
    $email = $me['email'];

    $exists = $connect->prepare('
      SELECT * FROM users
      WHERE email = :email
      LIMIT 1;
    ');
    $exists->execute(['email' => $email]);
    @$user = $exists->fetchAll();
    if (!$user) {
      $add = $connect->prepare("INSERT INTO users (email, password, privilege) VALUES (:email, NULL, 1);");
      $add->execute([
        'email' => $email,
      ]);
    }
    
    $minutesOfLogin = 60*12; //v minútach
    setcookie('email', $email, time() + $minutesOfLogin*60);
    setcookie('privilege', 1, time() + $minutesOfLogin*60);
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
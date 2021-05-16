<?php
  require "./partials/header.php";
  require "./_inc/require_unregistered.php";
  require "./_inc/composer/vendor/autoload.php";

  $fb = new \Facebook\Facebook([
    'app_id' => APP_ID,
    'app_secret' => APP_SECRET,
    'default_graph_version' => 'v2.10',
  ]);

  $helper = $fb->getRedirectLoginHelper();
  $loginUrl = $helper->getLoginUrl($LOGIN_CALLBACK_URL);

?>

<body id="login_page">

  <div id="login_box">
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
      <h1>Prihlásenie</h1>

      <?php require './_inc/login_processing.php'; ?>

      <div class="body">
        <label for="email">E-mail</label>
        <input name="email" type="text" class="email" value="<?= isset($email) ? $email : "" ?>" required>

        <label for="password">Heslo</label>
        <input name="password" type="password" class="password" required>
        <div id="show_password">
          <input name="show_password" type="checkbox">
          <label for="show_password">Ukázať heslo</label>
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Prihlásiť</button>
      <a class="home" href="index.php">späť</a>
      <br>
      <a class="register" href="signup.php">Nová registrácia</a>
      <hr>
      <p>Prihlásiť sa cez:</p>
      <a class="fb_login" href="<?= $loginUrl; ?>"><i class="fab fa-facebook-f"></i></a>
    </form>
  </div>

<?php require "./partials/footer.php"; ?>
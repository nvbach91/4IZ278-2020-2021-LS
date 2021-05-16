<?php
  require "./partials/header.php";

  require "./_inc/require_unregistered.php";

?>

<body id="signup_page">

<div id="signup_box">
  <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
    <h1>Registrácia</h1>
  
    <?php require './_inc/signup_processing.php'; ?>

    <div class="body">
      <label for="email">E-mail</label>
      <input name="email" type="text" class="email" value="<?= isset($email) ? $email : "" ?>" required>
      <small>E-mail musí byť platný</small>

      <label for="password">Heslo</label>
      <input name="password" type="password" class="password" required>
      <div id="show_password">
        <input name="show_password" type="checkbox">
        <label for="show_password">Ukázať heslo</label>
      </div>
      <small>Heslo musí obsahovať aspoň 6 znakov bez medzier.</small>
    </div>
    <button type="submit" class="btn btn-primary">Registrovať</button>
    <a class="home" href="login.php">späť</a>
  </form>
</div

<?php require "./partials/footer.php"; ?>
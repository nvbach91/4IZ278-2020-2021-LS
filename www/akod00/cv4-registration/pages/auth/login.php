<?php
  $pageTitle = "Login";
  $invalidInputs = [];
  $alertMessages = [];
  $alertType = 'alert-danger';
  $email = "";
  $password = "";
  $submittedForm = !empty($_POST);

  function tryGetPost($name)
  {
    return array_key_exists($name, $_POST)
      ? htmlspecialchars(trim($_POST[$name]))
      : null;
  }

  function validate($name)
  {
    global $invalidInputs;

    return in_array($name, $invalidInputs, true)
      ? " is-invalid"
      : "";
  }

  function field_isset($value)
  {
    return isset($value)
      ? $value
      : '';
  }

  if ($submittedForm)
  {
    $password = tryGetPost('password');
    $email = tryGetPost('email');

    if (!$password) {
      $alertMessages[] = 'Please enter a password';
      $invalidInputs[] = 'password';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $alertMessages[] = 'Please use a valid email';
      $invalidInputs[] = 'email';
    }
  }

?>

<?php require '../../components/header.inc.php'; ?>

<div class="col">
    <form method="post" class="form-group">
      <?php if ($submittedForm): ?>
          <div class="alert <?php echo $alertType; ?>">
            <?php echo implode('<br>', $alertMessages); ?>
          </div>
      <?php endif; ?>

        <!-- Email -->
        <div class="row mb-2">
            <div class="form-outline w-100">
                <input type="email"
                       name="email"
                       id="email"
                       value="<?php echo field_isset($email) ?>"
                       class="form-control<?php echo validate('email') ?>"
                       placeholder="Email"/>
            </div>
        </div>

        <!-- Password -->
        <div class="row mb-2">
            <div class="form-outline w-100">
                <input type="password"
                       name="password"
                       id="password"
                       value="<?php echo field_isset($password) ?>"
                       class="form-control<?php echo validate('password') ?>"
                       placeholder="Password"/>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <input type="checkbox" name="remember_me" class="mr-2">
                <label for="remember_me">Remember me</label><br>
            </div>
            <div class="col text-right">
                <a href="#">Forgot password?</a>
            </div>
        </div>

        <div class="row">
            <button class="btn btn-primary" type="submit">Login</button>
        </div>
    </form>
</div>
<p class="mt-2 pl-0">
    <a href="/pages/auth/registration.php">
        New member? Sign up
    </a>
</p>

<?php require '../../components/footer.inc.php'; ?>

<?php
  require "../../utils/utils.php";
  $pageTitle = "Register";
  $invalidInputs = [];
  $alertMessages = [];
  $alertType = 'alert-danger';

  $firstName = "";
  $lastName = "";
  $password = "";
  $confirmPassword = "";
  $gender = "";
  $email = "";
  $phone = "";
  $avatar = "";
  $cardPack = "";
  $cardCount = null;

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

  // check if form is submitted
  $submittedForm = !empty($_POST);
  if ($submittedForm)
  {
    $firstName = tryGetPost('first_name');
    $lastName = tryGetPost('last_name');
    $password = tryGetPost('password');
    $confirmPassword = tryGetPost('password_confirmation');
    $gender = tryGetPost('gender');
    $email = tryGetPost('email');
    $phone = tryGetPost('phone');
    $avatar = tryGetPost('avatar');
    $cardPack = tryGetPost('card_pack');
    $cardCount = array_key_exists('card_count', $_POST) && is_int($_POST['card_count'])
      ? (int)$_POST['card_count']
      : 1;

    if (!$firstName) {
      $alertMessages[] = 'Please enter your firstname';
      $invalidInputs[] = 'first_name';
    }

    if (!$lastName) {
      $alertMessages[] = 'Please enter your lastname';
      $invalidInputs[] = 'last_name';
    }

    if (!$password) {
      $alertMessages[] = 'Please enter a password';
      $invalidInputs[] = 'password';
    }

    if ($password !== $confirmPassword) {
      $alertMessages[] = 'Password and confirmed password fields must match';
      $invalidInputs[] = 'password_confirmation';
    }

    if (!in_array($gender, ['F', 'M'])) {
      $alertMessages[] = 'Please select a gender';
      $invalidInputs[] = 'gender';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $alertMessages[] = 'Please use a valid email';
      $invalidInputs[] = 'email';
    }

    if (!preg_match('/^(\+\d{3} ?)?(\d{3} ?){3}$/', $phone)) {
      $alertMessages[] = 'Please use a valid phone number';
      $invalidInputs[] = 'phone';
    }

    if (!filter_var($avatar, FILTER_VALIDATE_URL)) {
      $alertMessages[] = 'Please use a valid URL for your avatar';
      $invalidInputs[] = 'avatar';
    }

    if (!$cardPack) {
      $alertMessages[] = 'Please enter your card pack name';
      $invalidInputs[] = 'card_pack';
    }

    if (!$cardCount || !is_int($cardCount) || $cardCount < 0) {
      $alertMessages[] = 'Please enter a valid card count';
      $invalidInputs[] = 'card_count';
    }

    if (empty($alertMessages)) {
        $newUser = registerNewUser($_POST);
        if (!$newUser['success']) {
            $alertMessages[] = $newUser['message'];
        }
    }

    if (empty($alertMessages)) {
      header('Location: ./login.php');
      exit();
    }
  }

?>

<?php require '../../components/header.inc.php'; ?>

<div class="col">
  <?php if ($submittedForm): ?>
      <div class="alert <?php echo $alertType; ?>">
        <?php echo implode('<br>', $alertMessages); ?>
      </div>
  <?php endif; ?>

    <form method="post" class="form-signup">
        <!-- Name -->
        <div class="row mb-2">
            <!-- First -->
            <div class="col-sm" style="padding-left: 0">
                <div class="form-outline">
                    <input type="text"
                           name="first_name"
                           id="first_name"
                           value="<?php echo field_isset($firstName) ?>"
                           class="form-control<?php echo validate('first_name') ?>"
                           placeholder="Firstname"/>
                </div>
            </div>
            <!-- Last -->
            <div class="col-sm" style="padding-left: 0; padding-right: 0">
                <div class="form-outline">
                    <input type="text"
                           name="last_name"
                           id="last_name"
                           value="<?php echo field_isset($lastName) ?>"
                           class="form-control<?php echo validate('last_name') ?>"
                           placeholder="Lastname"/>
                </div>
            </div>
        </div>

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

        <!-- Confirm password -->
        <div class="row mb-2">
            <div class="form-outline w-100">
                <input type="password"
                       name="password_confirmation"
                       id="confirm_password"
                       value="<?php echo field_isset($confirmPassword) ?>"
                       class="form-control<?php echo validate('password_confirmation') ?>"
                       placeholder="Confirm password"/>
            </div>
        </div>

        <!-- Gender -->
        <div class="row mb-2">
            <select name="gender" id="gender" class="form-control<?php echo validate('gender') ?>" title="Gender">
                <option value="N" selected disabled>Gender...</option>
                <option value="M"<?php echo isset($gender) && $gender === 'M' ? ' selected' : '' ?>>Male</option>
                <option value="F"<?php echo isset($gender) && $gender === 'F' ? ' selected' : '' ?>>Female</option>
            </select>
        </div>

        <!-- Phone -->
        <div class="row mb-2">
            <input type="tel"
                   id="telephone"
                   name="phone"
                   placeholder="Phone"
                   value="<?php echo field_isset($phone) ?>"
                   class="form-control<?php echo validate('phone') ?>"/>
        </div>

        <!-- Avatar -->
        <div class="row mb-2">
          <?php if (isset($avatar) && $avatar): ?>
              <img class="avatar" src="<?php echo $avatar; ?>" alt="avatar">
          <?php endif; ?>

          <input type="url"
                 id="avatar"
                 name="avatar"
                 value="<?php echo field_isset($avatar) ?>"
                 placeholder="Avatar"
                 class="form-control<?php echo validate('avatar') ?>"/>
        </div>

        <!-- Cards -->
        <div class="row mb-2">
            <!-- Card pack -->
            <div class="col-sm" style="padding-left: 0">
                <div class="form-outline">
                    <input type="text"
                           name="card_pack"
                           id="card_pack"
                           value="<?php echo field_isset($cardPack) ?>"
                           class="form-control<?php echo validate('card_pack') ?>"
                           placeholder="Card pack"/>
                </div>
            </div>
            <!-- Last -->
            <div class="col-sm" style="padding-left: 0; padding-right: 0">
                <div class="form-outline">
                    <input type="number"
                           min="1"
                           name="card_count"
                           id="card_count"
                           value="<?php echo field_isset($cardCount) ?>"
                           class="form-control<?php echo validate('card_count') ?>"
                           placeholder="Card count"/>
                </div>
            </div>
        </div>

        <div class="row">
            <button class="btn btn-primary" type="submit">Submit</button>
        </div>
    </form>
</div>
<p class="mt-2 pl-0">
    <a href="/~akod00/cv04/pages/auth/login.php">
        Have an account? Sign in
    </a>
</p>

<?php require '../../components/footer.inc.php'; ?>

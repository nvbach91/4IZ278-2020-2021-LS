<?php
require "vendor/autoload.php";
session_start();

$invalidInputs = [];
$alertMessages = [];
$alertType = 'alert-danger';
$regexMail = '/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/iD';
$regexPassword = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/';

// check if form is submitted
$submittedForm = !empty($_POST);
if ($submittedForm) {

    $name = htmlspecialchars(trim($_POST['name']));
    $surname = htmlspecialchars(trim($_POST['surname']));
    $email = htmlspecialchars(trim($_POST['email']));
    $username = htmlspecialchars(trim($_POST['username']));
    $password = htmlspecialchars(trim($_POST['password']));
    $confirm = htmlspecialchars(trim($_POST['confirm']));

    // check name, regex allows unicode letters (abcd), accents (ěáí), hyphens(Anna-Marie), single quotes (Charlie O' Hara)
    if ($name == null) {
        array_push($alertMessages, 'Please enter your name');
        array_push($invalidInputs, 'name');
    }

    // check email, according to php docs validate email filter uses RFC 822 which is obsolete, lets use RFC 5322, internationalized mails wont work (e.g. 用户@例子.广告)
    if (!preg_match($regexMail, $email)) {
        array_push($alertMessages, 'Please use a valid email');
        array_push($invalidInputs, 'email');
    }

    // check passwords match
    if ($password !== $confirm) {
        array_push($alertMessages, 'Passwords dont match');
        array_push($invalidInputs, 'confirm');
    }

    if (!count($alertMessages)) {
        $password = password_hash($password, PASSWORD_DEFAULT);

        $db = new Database();

        try {
            $db->insert("
            INSERT INTO `orderperson`(
                      `OrderPersonEmail`,
                      `OrderPersonFirstname`,
                      `OrderPersonLastname`
                ) VALUES (:OrderPersonEmail,:OrderPersonFirstname,:OrderPersonLastname)",
                [
                    'OrderPersonEmail' => $email,
                    'OrderPersonFirstname' => $name,
                    'OrderPersonLastname' => $surname,
                ]
            );
            $id = $db->select("SELECT LAST_INSERT_ID()");
            $db->insert("
            INSERT INTO `user`(
                        `OrderPersonID`,
                        `UserName`,
                        `UserPassword`
                ) VALUES (:OrderPersonID,:UserName,:UserPassword)",
                [
                    'OrderPersonID' => array_values($id[0])[0],
                    'UserName' => $username,
                    'UserPassword' => $password,
                ]
            );
        } catch (Exception $e) {
            preg_match('/[^:\s]+(?=;[^;]*$)/',$e,$match);
            if (array_shift($match) == '23000'){
                array_push($alertMessages,'User already exists');
            } else array_push($alertMessages,$e->getMessage());
        }

        header('Location: login.php?ref=registration&email=' . $email);
    }
}
?>

<?php require './incl/header.php'; ?>

<main class="text-center">
    <form class="form-signup" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <?php if ($submittedForm): ?>
            <div class="alert <?php echo $alertType; ?>"><?php echo implode('<br>', $alertMessages); ?></div>
        <?php endif; ?>
        <img class="mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Please sign up</h1>
        <label for="inputName" class="sr-only">First name</label>
        <input type="text"
               id="inputName"
               class="form-control <?php echo in_array('name', $invalidInputs) ? ' is-invalid' : '' ?>"
               name="name" value="<?php echo $name ?? '' ?>"
               placeholder="First name"
               required=""
               autofocus="">
        <label for="inputSurname" class="sr-only">Last name</label>
        <input type="text"
               id="inputSurname"
               class="form-control <?php echo in_array('surname', $invalidInputs) ? ' is-invalid' : '' ?>"
               name="surname" value="<?php echo $surname ?? '' ?>"
               placeholder="Last name"
               required=""
               autofocus="">
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email"
               id="inputEmail"
               class="form-control <?php echo in_array('email', $invalidInputs) ? ' is-invalid' : '' ?>"
               name="email" value="<?php echo $email ?? '' ?>"
               placeholder="Email address"
               required=""
               autofocus="">
        <label for="inputUsername" class="sr-only">Username</label>
        <input autofocus=""
               class="form-control <?php echo in_array('username', $invalidInputs) ? ' is-invalid' : '' ?>"
               id="inputUsername"
               name="username" placeholder="Your username"
               required=""
               value="<?php echo $username ?? '' ?>">
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password"
               id="inputPassword"
               class="form-control <?php echo in_array('password', $invalidInputs) ? ' is-invalid' : '' ?>"
               name="password" value="<?php echo $password ?? '' ?>"
               placeholder="Password"
               required="">
        <label for="inputConfirm" class="sr-only">Confirm password</label>
        <input type="password"
               id="inputConfirm"
               class="form-control <?php echo in_array('confirm', $invalidInputs) ? ' is-invalid' : '' ?>"
               name="confirm" value="<?php echo $confirm ?? '' ?>"
               placeholder="Password again"
               required="">
        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" value="tos"> Accept TOS
            </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign up</button>
    </form>
</main>

<?php require './incl/footer.php'; ?>

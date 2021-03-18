<?php
require __DIR__ . '/includes/core.php';


$isSubmited = !empty($_POST);

$errors = array();

$validForm = false;

if ($isSubmited) {
    $name = htmlspecialchars(trim($_POST["name"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $password = trim($_POST["password"]);
    $confirm = trim($_POST["confirmPassword"]);



    if (!$name) {
        array_push($errors, "Jméno je prázdné");
    }

    if (!$email) {
        array_push($errors, "Email je prázdný");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Email je neplatný");
    }

    if (!$password) {
        array_push($errors, "Heslo nesmí být prazdné");
    }
    if (!$confirm) {
        array_push($errors, "Je třeba vyplnit potvrzení hesla");
    }
    if ($password != $confirm) {
        array_push($errors, "Hesla se neshodují");
    }

    if (empty($errors)) {
        $data = array(
            'name' => $name,
            'email' => $email,
            'password' => $password,
        );
        $result = registerNewUser($data);
        if ($result['success']) {
            sendMail($data['email'], "Registrace úspěšná", $data['name'] . ", Vaše registrace byla úspěšná");
            header('Location: login.php?email=' . $data['email']);
        } else {
            array_push($errors, "Uživatel již existuje");
        }
    }


    $validForm = !count($errors);

}


include __DIR__ . '/includes/head.php';
include __DIR__ . '/includes/navigation.php';

?>

<div class="login-page">
    <form method="POST" class="form-signin">
        <?php foreach ($errors as $error) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>
        <h1 class="h3 mb-3 font-weight-normal">Registration form</h1>
        <div class="form-group">
            <label for="inputName" class="sr-only">Name</label>
            <input name="name" type="text" id="inputName" class="form-control" placeholder="Name" value="<?php echo empty($name) ? "" : $name; ?>" autofocus="">
        </div>
        <div class="form-group">
            <label for="inputEmail" class="sr-only">Email address</label>
            <input name="email" type="text" id="inputEmail" class="form-control" placeholder="Email address" value="<?php echo empty($email) ? "" : $email; ?>">
        </div>
        <div class="form-group">
            <label for="inputEmail" class="sr-only">Password</label>
            <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password">
        </div>
        <div class="form-group">
            <label for="inputEmail" class="sr-only">Confirm password</label>
            <input name="confirmPassword" type="password" id="inputCPassword" class="form-control" placeholder="Confirm password" >
        </div>

        <button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
    </form>
</div>

<?php include __DIR__ . '/includes/foot.php'; ?>
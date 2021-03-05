<?php include __DIR__ . '/includes/head.php' ?>
<?php
/*if (empty($_GET)) {
        $isSubmitted = false;
    } else {
        $isSubmitted = true;
    }*/

$isSubmitted = empty($_GET) ? false : true;

$invalidInputs = [];

if ($isSubmitted) {
    //var_dump($_GET); // $_POST
    $email    = htmlspecialchars(trim($_GET['email']));
    $password = htmlspecialchars(trim($_GET['password']));
    $remember = isset($_GET['remember']) ? true : false;
    echo $email;
    if (!$email) {
        array_push($invalidInputs, 'Email je prazdny!');
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($invalidInputs, 'Email je neplatny!');
    }
    if (!$password) {
        array_push($invalidInputs, 'Heslo je prazdne!');
    }
    if (!preg_match('/^[a-zA-Z0-9]{8,}$/', $password)) {
        array_push($invalidInputs, 'Heslo je prilis kratke!');
    }

    $isValidForm = !count($invalidInputs); // == 0;
    if ($isValidForm) {
        // do something more
    }
    // echo "$email<br>$password<br>$remember<br>end.";
}
?>

<h1>Ahoj svete</h1>
<main>
    <?php if ($isSubmitted) : ?>
        <h2>You have submitted the form</h2>
    <?php endif; ?>

    <?php if ($isValidForm) : ?>
        <h2>The form is valid, you are awesome.</h2>
    <?php else : ?>
        <h2>The form is not valid, please try again.</h2>
    <?php endif; ?>

    <?php foreach ($invalidInputs as $invalidInput) : ?>
        <p class="error-message"><?php echo $invalidInput; ?></p>
    <?php endforeach; ?>
    <form>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input value="<?php echo isset($email) ? $email : ''; ?>" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input value="<?php echo isset($password) ? $password : ''; ?>" name="password" class="form-control" id="exampleInputPassword1">
        </div>
        <div class="mb-3 form-check">
            <input <?php echo isset($remember) && $remember == true ? 'checked' : ''; ?> name="remember" type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Remember me</label>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</main>


<?php include __DIR__ . '/includes/foot.php' ?>
<?php include __DIR__ . '/includes/head.php' ?>
<?php
$invalidInputs = [];
$message = '';
$isSubmitted = !empty($_GET); // $_POST
/*if (empty($_GET)) {
        $isSubmitted = false;
    } else {
        $isSubmitted = true;
    }*/

if ($isSubmitted) {
    $email =    htmlspecialchars(trim($_GET['email']));
    $password = htmlspecialchars(trim($_GET['password']));
    $remember = isset($_GET['remember']) ? true : false;
    /*if ($_GET['remember']) {
        $remember = true;
    } else {
        $remember = false;
    }*/
    // qweqweasd@gmail.com
    //  /[a-zA-Z0-9]@[a-zA-Z0-9]\.[a-zA-Z]{2,3}/
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($invalidInputs, 'Email neni validni');
    }
    if (!$email) {
        // tady bude chyba 
        array_push($invalidInputs, 'Musite vyplnit email');
    }
    if (!preg_match('/^[a-zA-Z0-9]{8,}$/', $password)) {
        array_push($invalidInputs, 'Heslo neni validni');
    }
    if (!$password) {
        // tady bude chyba
        array_push($invalidInputs, 'Musite vyplnit heslo');
    }

    if (!count($invalidInputs)) {
        $msg = 'You have successfully loged in';
    }
}

?>
<main>
    <h1>Some form</h1>

    <?php if ($isSubmitted) : ?>
        <?php if (!empty($invalidInputs)) : ?>
            <?php foreach ($invalidInputs as $msg) : ?>
                <p><?php echo $msg; ?></p>
            <?php endforeach; ?>
        <?php endif; ?>
        <h2>Your have submitted the form</h2>
        <?php if ($msg) : ?>
            <h3><?php echo $msg; ?></h3>
        <?php endif; ?>
    <?php endif; ?>
    <form>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input name="email" value="<?php echo isset($email) ? $email : '' ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input name="password" value="<?php echo isset($password) ? $password : '' ?>" class="form-control" id="exampleInputPassword1">
        </div>
        <div class="mb-3 form-check">
            <input name="remember" <?php echo isset($remember) && $remember == true ? 'checked' : '' ?> type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</main>



<?php include __DIR__ . '/includes/foot.php' ?>
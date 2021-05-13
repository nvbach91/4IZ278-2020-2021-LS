<?php

require __DIR__ . '/utils/utils.php';

$invalidInputs = [];

$isSubmitted = !empty($_POST); //if ($_SERVER["REQUEST_METHOD"] == "POST") {
$message = "";

if ($isSubmitted) {
    $name = htmlspecialchars(trim($_POST['name']));
    $password = htmlspecialchars(trim($_POST['password']));

    //Name
    if (empty($name)) {
        array_push($invalidInputs, 'Name is not filled');
    }

    if (empty($password)) {
        array_push($invalidInputs, 'Password is not filled');
    }

    if(empty($invalidInputs)){
        //TODO get user?
        header('Location: index.php');
        exit();
    }
    /*
    //mail
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($invalidInputs, 'Email is not valid');
    }

    //Phone
    if (!preg_match("/^[0-9]{9}$/", $phone)) {
        array_push($invalidInputs, 'Phone number is not valid');
    }

    //url
    if (!filter_var($avatar, FILTER_VALIDATE_URL)) {
        array_push($invalidInputs, 'URL is not valid');
    }

    if (!count($invalidInputs)) {
        $message = 'You have sucessfully logged into tournament';
    } */
}

?>

<?php require __DIR__ . '/includes/head.php'; ?>

    <main>
        <div style="width: 20%; text-align: center; margin: 0 auto;">
            <h1>
                Login or Register
            </h1>
            <form class="form-signup" method="POST">
                <?php if ($isSubmitted) : ?>
                    <?php if (!empty($invalidInputs)) : ?>
                        <div class="alert alert-danger">
                        <?php foreach ($invalidInputs as $msg) : ?>
                            <p><?php echo $msg; ?></p>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </div>
                    <?php if ($message) : ?>
                        <div class="alert-success">
                            <h3><?php echo $message; ?></h3>
                        </div>
                        <img width="200" height="200" src="<?php echo $avatar ?>" alt="avatar">
                    <?php endif; ?>
                <?php endif; ?>
                <div class="form-group">
                    <label>Name</label>
                    <input class="form-control" name="name" value="<?php echo isset($name) ? $name : '' ?>">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input class="form-control" name="password" value="<?php echo isset($password) ? $password : '' ?>">
                </div>
                <button class="btn btn-primary" type="submit">Přihlásit</button>
            </form>
            <button class="fa fa-facebook"></button>
    </main>

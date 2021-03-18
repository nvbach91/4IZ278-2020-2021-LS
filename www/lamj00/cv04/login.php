<?php require './logic/logic_login.php';?>

<?php require './includes/head.php'; ?>
<body>
<?php include './includes/navigation.php';?>
<main class="container">
    <br>
    <h1 class="text-center">Log in</h1>
    <div class="row justify-content-center">
    <ul>
        <?php foreach($invalidInputs as $msg):?>
                    <div class="error"><?php echo $msg;?></div>
        <?php endforeach; ?>
    </ul>
    </div>
        <form class="form-login" method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">

            <div class="form-group">
                <label>Email*</label>
                <input class="form-control" name="email" value="<?php echo isset($email) ? $email : '' ?>">
                <small class="text-muted">Example: example@gmail.com</small>
            </div>
            <div class="form-group">
                <label>Heslo*</label>
                <input class="form-control" name="password" value="<?php echo isset($password) ? $password : '' ?>">
                <small class="text-muted">Example: 123456789</small>
            </div>

            <button class="btn btn-primary" type="Login">login</button>
        </form>
    </div>
</main>
</body>
<?php require './hotreloader.php'; ?>
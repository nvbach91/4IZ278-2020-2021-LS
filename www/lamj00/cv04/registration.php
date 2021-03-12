<?php  require './logic/logic_registration.php'; ?>

<?php require './includes/head.php'; ?>
<body>

<?php include './includes/navigation.php';?>

<main class="container">
    <br>
    <h1 class="text-center">Registration</h1>
    <div class="row justify-content-center">
    <ul >
        <?php foreach($invalidInputs as $msg):?>
                    <div class="error"><?php echo  $msg;?></div>
        <?php endforeach; ?>
    </ul>

        <form class="form-signup" method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label>Name*</label>
                <input class="form-control" name="name" value="<?php echo isset($name) ? $name : '' ?>">
                <small class="text-muted">Example: Homer Simpson</small>
            </div>
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
            <div class="form-group">
                <label>Potvrdit heslo*</label>
                <input class="form-control" name="approve_password" value="<?php echo isset($approve_password) ? $approve_password : '' ?>">
            </div>
            <button class="btn btn-primary" type="submit">Submit</button>
        </form>
    </div>
</main>
</body>
<?php require './hotreloader.php'; ?>
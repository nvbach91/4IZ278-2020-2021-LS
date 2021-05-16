<?php
require "incl/header.php";
require "incl/navbar.php";

?>
<main class="cont">

    <h1 class="text-center">Log in</h1>
    <div class="row justify-content-center">
        <ul>

        </ul>
    </div>
    <form class="form-login" method="POST" action="">

        <div class="form-group">
            <label>Email*</label>
            <input class="form-control" name="email" value="<?php echo isset($email) ? $email : '' ?>">
            <small class="text-muted">Example: example@gmail.com</small>
        </div>
        <div class="form-group">
            <label>Heslo*</label>
            <input class="form-control" name="password" value="<?php echo isset($password) ? $password : '' ?>">
            <br>
        </div>

        <button class="btn btn-primary" type="Login">login</button>
    </form>
    </div>
</main>
<?php
require  "incl/footer.php";
?>



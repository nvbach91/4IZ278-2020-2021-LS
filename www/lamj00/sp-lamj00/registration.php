<?php
require "incl/header.php";
require "incl/navbar.php";

?>
<main class="cont">

    <h1 class="text-center">Register</h1>
    <div class="row justify-content-center">
    </div>
    <form class="form-login" method="POST" action="">

        <div class="form-group">
            <label>Name*</label>
            <input class="form-control" name="email" >
            <small class="text-muted">Must be  etc etc</small>
        </div>
        <div class="form-group">
            <label>Password*</label>
            <input class="form-control" name="password" placeholder="Password">
            <input style="margin-top: 5px" class="form-control" name="password" placeholder="Confirm password">
            <small class="text-muted">Must be  etc etc</small>
        </div>
        <div class="form-group">

            <br>
        </div>
        <div class="form-group">
            <label>Email address*</label>
            <input class="form-control" name="password" value="" placeholder="Email">
            <small class="text-muted">Example: example@gmail.com</small>
            <br>
        </div>


        <button class="btn btn-primary" type="Login">Submit</button>
    </form>
    </div>
</main>
<?php
require  "incl/footer.php";
?>



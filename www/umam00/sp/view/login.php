<?php include('controller/login_check.php') ?>     
<!DOCTYPE html>
<html lang="en">
<?php include('view/head.php') ?>
<body>
<div class="row">
        <div class="col-12 col-md-5">
            <div class="vertic-100 p-4 p-sm-5">
                <div class="row h-100">
                    <div class="col-12 mb-sm-0 mb-5 p-0">
                        <?php require('view/logo.php');?>
                    </div>
                    <div class="col-12 gx-0 ">
                        <h1 class="bold">Sign in</h1>
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="login-form ">
                            <div class="inp form-floating">
                                <input type="text" class="form-control" name="email" id="email" placeholder="&nbsp;" required>
                                <label for="name">email</label>
                            </div>
                            <div class="inp form-floating">
                                <input type="password" class="form-control" name="password" id="password" placeholder="&nbsp;" required>
                                <label for="password">password</label>
                                <a href="#">Forgot passoword?</a>
                            </div>
                            <button type="submit" name="btn_login" class="btn-log">Sign in</button>
                            <p class="error_msg"><?php include('controller/fce_error.php')?></p>
                        </form>
                        <p class="or">or</p>
                        <button class="btn-fb" >Sign in via <b>facebook</b></button>
                        <hr>
                        <p class="reg">dont have an account? <a href="registration.php">Sing up</a></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-7 gx-0 d-none d-sm-block">
            <div class="vertic-100 p-4 p-sm-0 bg-yellow d-flex ">
                <div class="row gx-0 my-auto p-1 p-sm-5 d-flex">
                    <div class="col-12">
                        <h2 class="title center">welcome to noter</h2>
                    </div>
                    <div class="col-12 mb-5">
                        <p class="sub-title">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Neque earum delectus temporibus autem nam laudantium atque explicabo dolor, nobis non?</p>
                    </div>
                    <div class="col-12 center ">
                        <?php include('view/soc_icons.php'); ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
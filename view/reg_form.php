<?php include('controller/reg_check.php') ?>
<!DOCTYPE html>
<html lang="en">
<?php include('view/head.php') ?>
<body>
<div class="row gx-0">
        <div class="col-12 col-md-5 gx-0">
            <div class="vertic-100 p-5">
                <div class="row gx-0 h-100">
                    <div class="col-12">
                        <?php require('view/logo.php');?>
                    </div>
                    <div class="col-12">
                        <h1 class="bold">Sing up</h1>
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="login-form ">
                            <div class="inp form-floating">
                                <input type="text" class="form-control" name="name" id="name" placeholder="&nbsp;" required>
                                <label for="name">name</label>
                            </div>
                            <div class="inp form-floating">
                                <input type="text" class="form-control" name="email" id="email" placeholder="&nbsp;" required>
                                <label for="email">email</label>
                            </div>
                            <div class="inp form-floating">
                                <input type="password" class="form-control" name="password" id="password" placeholder="&nbsp;" required>
                                <label for="password">password</label>
                            </div>
                            <div class="inp form-floating">
                                <input type="password" class="form-control" name="password_check" id="password_check" placeholder="&nbsp;" required>
                                <label for="password_check">password again</label>
                            </div>
                            <button type="submit" name="btn_reg" class="btn-log">Sign up</button>
                            <p class="error_msg"><?php include('controller/fce_error.php')?></p>
                        </form>
                        <p class="or">or</p>
                        <button class="btn-fb" >Sign up via <b>facebook</b></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-7 gx-0">
            <div class="vertic-100 bg-yellow d-flex">
                <div class="row gx-0 my-auto p-5 d-flex">
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
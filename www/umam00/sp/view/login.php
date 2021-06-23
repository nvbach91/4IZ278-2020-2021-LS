<?php
include('controller/login_check.php');
include('controller/reset_pass.php');

$quotes = [
    '"One day I will find the right words, and they will be simple."',
    '"A word after a word after a word is power."',
    '"Tears are words that need to be written.',
    '"Writing is like sex. First you do it for love, then you do it for your friends, and then you do it for money."',
    '"The purpose of a writer is to keep civilization from destroying itself."',
    '"Ideas are like rabbits. You get a couple and learn how to handle them, and pretty soon you have a dozen."',
    '"Words do not express thoughts very well. They always become a little different immediately after they are expressed, a little distorted, a little foolish."'
    ]
?>

<!DOCTYPE html>
<html lang="en">
<?php include('view/head.php') ?>

<body>
    <div class="row">
        <div class="col-12 col-md-5">
            <div class="vertic-100 p-4 p-sm-5">
                <div class="row h-100">
                    <div class="col-12 mb-sm-0 mb-5 p-0">
                        <?php require('view/logo.php'); ?>
                    </div>
                    <?php
                    if (isset($_GET['lost_pass']))
                    { ?>
                        <div class="col-12 gx-0 ">
                            <h1 class="bold">Lost password?</h1>
                            <p>Dont worry, we can just reset it.</p>
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="login-form ">
                                <div class="inp form-floating">
                                    <input type="text" class="form-control" name="email" id="email" placeholder="&nbsp;" required>
                                    <label for="name">email</label>
                                </div>
                                <button type="submit" name="btn_reset_pass" class="btn-log">Reset password</button>
                                <p class="error_msg"><?php include('controller/fce_error.php') ?></p>
                            </form>
                        </div>
                    <?php }
                    else {
                    ?>
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
                                    <a href="?lost_pass">Forgot passoword?</a>
                                </div>
                                <button type="submit" name="btn_login" class="btn-log">Sign in</button>
                                <p class="error_msg"><?php include('controller/fce_error.php') ?></p>
                            </form>
                            <p class="or">or</p>
                            <button class="btn-fb">Sign in via <b>facebook</b></button>
                            <hr>
                            <p class="reg">dont have an account? <a href="registration.php">Sing up</a></p>
                        </div>
                        <?php } ?>
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
                        <p class="sub-title text-center"><?php echo randomQuotes($quotes); ?></p>
                    </div>
                    <div class="col-12 center ">
                        <?php include('view/soc_icons.php'); ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
<!DOCTYPE html>
<html lang="en">
<?php
include ('view/head.php');
include ('model/pdo.php');
include ('model/user_data.php');
?>
<body>
<div class="main-container">
<div class="row gx-0">
            <div class="col-12 col-md-5 gx-0">
                <div class="vertic-100 p-5">
                    <div class="row gx-0 h-100">
                        <div class="col-12">
                            <h1 class="bold">Settings</h1>
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="login-form ">
                                <div class="inp form-floating">
                                    <input type="text" class="form-control" name="name" value="<?php echo $data['name']; ?>" placeholder="&nbsp;">
                                    <label for="name">name</label>
                                </div>
                                <div class="inp form-floating">
                                    <input type="text" class="form-control" name="email"  value="<?php echo $data['email']; ?>" disabled placeholder="&nbsp;" required>
                                    <label for="email">email</label>
                                </div>
                                <div class="inp form-floating">
                                    <input type="password" class="form-control" name="password" i placeholder="&nbsp;" required>
                                    <label for="password">password</label>
                                </div>
                                <div class="inp form-floating">
                                    <input type="password" class="form-control" name="new_pass" placeholder="&nbsp;">
                                    <label for="password_check">new password again</label>
                                </div>
                                <div class="inp form-floating">
                                    <input type="password" class="form-control" name="new_pass_check"  placeholder="&nbsp;" >
                                    <label for="password_check">password again</label>
                                </div>
                                <button type="submit" name="btn_update_user" class="btn-log" value="update">Apply</button>
                                <p class="error_msg">
                                <?php 
                                if(isset($_GET['error']))
                                {
                                    if($_GET['error'] == 1)
                                    {
                                        echo "Wrong password.";
                                    }
                                    elseif($_GET['error'] == 2)
                                    {
                                        echo "New passwords has to match.";
                                    }
                                }
                                ?>
                                </p>
                                <p class="succ_msg">
                                <?php 
                                if(isset($_GET['success']))
                                {
                                        echo "Data updated succesfully!";
                                }
                                ?>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
</div>
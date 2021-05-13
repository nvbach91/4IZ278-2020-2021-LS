<?php
session_start();
require("database/Db.php");
require("database/Dao.php");
$error= isset($_SESSION['username']) ? "Už jsi přihlášený!" : "";
if(!empty($_POST))
{
    if(isset($_POST['login']))
    {
        $conn = new Db("localhost","Hruska","Lisa1959","eshop");
        $conn->createConn();


        $dao = new Dao($conn->getConn());
        $user = $dao->getUserByUsername($_POST['username']);

        if(password_verify($_POST['password'],$user->password))
        {
            $_SESSION['username'] = $user->username;
            $_SESSION['permission'] = $user->permission;
            $_SESSION['user'] = serialize($dao->getUser($user));
            header("Location: ./");
        }
        else
            $error = "Špatné uživatelské jméno nebo heslo";

        $conn->closeConn();
    }
}
?>
<?php require("utils/header.php"); ?>

<div class="container-fluid">
    <div class="row">
        <?php require("utils/side.php"); ?>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mb-5">
            <div class="card d-flex justify-content-between flex-wrap align-items-center mt-3">
                <div class="row">
                    <div class="col">
                        <a href="./login.php" class="btn btn-light">Přihlášení</a>
                    </div>
                    <div class="col">
                        <a href="./register.php" class="btn btn-light">Registrace</a>
                    </div>
                </div>

            </div>
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h2>Přihlášení</h2>

            </div>
            <div class="container" style="width:50%">
                <div class="alert-danger text-center mb-4"><?=$error;?></div>
                <?php if(!isset($_SESSION['username'])): ?>
                <form method="post">
                    <div class="form-group pb-1">
                        <input type="text" class="form-control" placeholder="Uživatelské jméno" name="username" required>
                    </div>
                    <div class="form-group pb-1">
                        <input type="password" class="form-control" placeholder="Heslo" name="password" required>
                    </div>
                    <input type="submit" class="btn btn-dark" style="width: 100%" value="Přihlásit se" name="login">
                </form>
                <?php endif; ?>
            </div>



        </main>
    </div>
</div>
<?php require("utils/footer.php"); ?>

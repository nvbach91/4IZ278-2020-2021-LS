<?php
session_start();
require("database/Db.php");
require("database/Dao.php");
$error= isset($_SESSION['username']) ? "Už jsi přihlášený, nemůžeš se zaregistrovat!" : "";

if(!empty($_POST))
{
    if(isset($_POST['register']))
    {
        $conn = new Db("localhost","Hruska","Lisa1959","eshop");
        $conn->createConn();

        $pwd = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $user = new User(0,$_POST['username'],$pwd,$_POST['surname'],$_POST['lastname'],1);

        $dao = new Dao($conn->getConn());
        $dao->createUser($user);

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
                <h2>Registrace</h2>

            </div>
            <div class="container" style="width:50%">
                <div class="alert-danger text-center mb-4"><?=$error;?></div>
                <?php if(!isset($_SESSION['username'])): ?>
                <form method="post">
                    <div class="form-group pb-1">
                        <input type="text" placeholder="Uživatelské jméno" name="username" class="form-control" required>
                    </div>
                    <div class="form-group pb-1">
                        <input type="password" placeholder="Heslo" name="password" class="form-control" required>
                    </div>
                    <div class="form-group pb-1">
                        <input type="text" placeholder="Jméno" name="surname" class="form-control" required>
                    </div>
                    <div class="form-group pb-1">
                        <input type="text" placeholder="Přijmení" name="lastname" class="form-control" required>
                    </div>
                    <input type="submit" value="Registrovat se" class="btn btn-dark" style="width: 100%" name="register">
                </form>
                <?php endif; ?>
            </div>


        </main>
    </div>
</div>
<?php require("utils/footer.php"); ?>

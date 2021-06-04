<?php
    session_start();
    require("database/Db.php");
    require("database/Dao.php");
    $error = "";

    if(!isset($_SESSION['user']))
    {
        header("Location: ./login.php");
        die;
    }

    if(!isset($_SESSION['username']))
        header("Location ./login.php");

    $user = unserialize($_SESSION['user']);

    if(!empty($_POST))
    {
        if(isset($_POST['profilechange']))
        {
            $newpwd = !($_POST['password'] == "");

            if($newpwd)
            {
                $pwd = password_hash($_POST['password'], PASSWORD_BCRYPT);
                $user->setPassword($pwd);
            }
            $user->setUsername($_POST['username']);
            $user->setLastname($_POST['lastname']);
            $user->setSurname($_POST['surname']);



            $conn = new Db(DB_Server,DB_User,DB_Pass,DB_DB);
            $conn->createConn();
            $dao = new Dao($conn->getConn());
            $dao->saveUser($user);
            $dao->updateSession($user);
            $error = "Změny byly zapsány.";
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
                        <a href="?p=1" class="btn btn-light">Profil</a>
                    </div>
                    <div class="col">
                        <a href="?p=2" class="btn btn-light">Objednávky</a>
                    </div>
                    <div class="col">
                        <a href="?logout=1" class="btn btn-light">Odhlášení</a>
                    </div>
                </div>

            </div>

                <?php if(!isset($_GET['p']) || $_GET["p"] == 1): ?>
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2><?php if(isset($_GET['e'])): ?><a href="?p=1">Profil</a><?php else:?>Profil <?php endif;?>  | <?php if(!isset($_GET['e'])): ?><a href="?p=1&e=1">Upravit profil</a><?php else:?>Upravit profil <?php endif;?> </h2>

            </div>
                <?php if(!isset($_GET['e'])): ?>
                <div class="container" style="width: 70%">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Uživatelské jméno</th>
                                <th>Jméno</th>
                                <th>Příjmení</th>
                                <th>Oprávnění</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?=$user->getUsername();?></td>
                                <td><?=$user->getSurname();?></td>
                                <td><?=$user->getLastname();?></td>
                                <td><?=$user->getPermissionid();?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <?php elseif ($_GET['e'] == 1): ?>
                    <div class="container">
                        <div class="alert-success text-center mb-4"><?=$error;?></div>
                        <form method="post">
                            <div class="form-group">
                                <label for="username">Uživatelské jméno</label>
                                <input class="form-control" type="text" value="<?=$user->getUsername();?>" id="username" name="username">
                            </div>
                            <div class="form-group">
                                <label for="surname">Jméno</label>
                                <input class="form-control" type="text" value="<?=$user->getSurname();?>" id="surname" name="surname">
                            </div>
                            <div class="form-group">
                                <label for="lastname">Příjmení</label>
                                <input class="form-control" type="text" value="<?=$user->getLastname();?>" id="lastname" name="lastname">
                            </div>
                            <div class="form-group">
                                <label for="password">Nové heslo</label>
                                <input class="form-control" type="password" value="" id="password" name="password">
                            </div>
                            <input type="submit" value="Uložit změny" class="btn btn-dark mt-4" style="width: 100%" name="profilechange">

                        </form>
                    </div>
                <?php endif; elseif ($_GET["p"] == 2): ?>
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

            <h2>Objednávky</h2>
            </div>

                <?php endif; ?>




        </main>
    </div>
</div>
<?php require("utils/footer.php"); ?>

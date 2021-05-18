<?php
session_start();
require("database/Db.php");
require("database/Dao.php");
$error = "";
$success = "";

$conn = new Db("localhost","Hruska","Lisa1959","eshop");
$conn->createConn();
$dao = new Dao($conn->getConn());

if(!empty($_POST))
{
    if(isset($_POST['delCat']))
    {
        $id = $_POST['id'];
        $dao->deleteCategory(new Category($id, "",""));
        $success = "Kategorie úspěšně odebrána";
    }
    if(isset($_POST['addCategory']))
    {
        $name = $_POST['name'];
        $desc = $_POST['desc'];
        $dao->insertCategory(new Category(0, $name, $desc));
        $success = "Kategorie úspěšně přidána";
    }
    if(isset($_POST['submit']))
    {
        $results = $dao->fetchUsers();
        $users = [];
        foreach ($results as $result)
            array_push($users, new User($result["userId"],$result["username"],$result["password"],$result["surname"],$result["lastname"],$result["permissionId"]));

       foreach ($_POST["username"] as $user)
        {
            foreach ($users as $u)
            {
                if($u->getUsername() == $user)
                {
                    $u->setPermissionId($_POST['permission'.$user]);
                    $dao->saveUser($u);
                }
            }
        }
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
                    <div class="col-sm-3">
                        <a href="?p=1" class="btn btn-light text-justify">Produkty</a>
                    </div>
                    <div class="col-sm-3">
                        <a href="?p=2" class="btn btn-light text-justify">Kategorie</a>
                    </div>
                    <div class="col-sm-3">
                        <a href="?p=3" class="btn btn-light text-justify">Objednávky</a>
                    </div>
                    <div class="col-sm-3">
                        <a href="?p=4" class="btn btn-light text-justify">Oprávnění</a>
                    </div>
                </div>

            </div>
            <?php if(!isset($_GET['p']) || $_GET["p"] == 1): ?>
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h2>Produkty</h2>

            </div>
            <div class="container">
                <div class="row mt-5">
                     <a href="" class="btn btn-dark text-justify">Přidat produkt</a>
                </div>
                <div class="row mt-3">
                     <a href="" class="btn btn-dark text-justify">Odebrat produkt</a>
                </div>
                <div class="row mt-3">
                     <a href="" class="btn btn-dark text-justify">Prohlížet produkty</a>
                </div>
            </div>

            <?php elseif($_GET["p"] == 2 && !isset($_GET["x"])): ?>
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>Kategorie</h2>

                </div>
                <div class="container">
                    <div class="row mt-5">
                        <a href="administration.php?p=2&x=1" class="btn btn-dark text-justify">Přidat kategorii</a>
                    </div>
                    <div class="row mt-3">
                        <a href="administration.php?p=2&x=2" class="btn btn-dark text-justify">Odebrat kategorii</a>
                    </div>
                    <div class="row mt-3">
                        <a href="administration.php?p=2&x=3" class="btn btn-dark text-justify">Prohlížet kategorie</a>
                    </div>
                </div>

            <?php elseif($_GET["p"] == 2 && $_GET['x'] == 1):  ?>
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>Přidat kategorii</h2>
                </div>
                <div class="container">
                    <div class="alert-success text-center mb-4"><?=$success;?></div>
                    <form method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Název kategorie" name="name">
                            <textarea type="text" class="form-control mt-2" placeholder="Popis kategorie" name="desc"></textarea>
                            <input type="submit" name="addCategory" class="btn btn-dark mt-4" style="width: 100%">

                        </div>

                    </form>
                </div>
            <?php elseif($_GET["p"] == 2 && $_GET['x'] == 2): ?>
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>Odebrat kategorii</h2>

                </div>

                <div class="container">
                    <div class="alert-success text-center mb-4"><?=$success;?></div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Název</th>
                            <th>Popisek</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($dao->fetchCategories() as $category): ?>
                            <tr>
                                <form method="post">
                                <td><input type="hidden" name="id" value="<?= $category->getCategoryId(); ?>"><?= $category->getCategoryId(); ?></td>
                                <td><?= $category->getName(); ?></td>
                                <td><?= $category->getDescription(); ?></td>
                                <td><input type="submit" name="delCat" value="Odebrat"></td>
                                </form>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php elseif($_GET["p"] == 2 && $_GET['x'] == 3): ?>
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>Prohlížet kategorie</h2>
                </div>
                <div class="container">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Název</th>
                            <th>Popisek</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($dao->fetchCategories() as $category): ?>
                            <tr>
                                <td><?= $category->getCategoryId(); ?></td>
                                <td><?= $category->getName(); ?></td>
                                <td><?= $category->getDescription(); ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            <?php elseif($_GET["p"] == 3): ?>
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>Objednávky</h2>

                </div>
                <div class="container">
                    <div class="row mt-5">
                        <a href="" class="btn btn-dark text-justify">Čekající objednávky</a>
                    </div>
                    <div class="row mt-3">
                        <a href="" class="btn btn-dark text-justify">Vyřízené objednávky</a>
                    </div>
                </div>
            <?php elseif($_GET["p"] == 4): ?>
            <?php
                $results = $dao->fetchUsers();
                $users = [];
                $permissions = $dao->createPermissions();
                foreach ($results as $result)
                    array_push($users, new User($result["userId"],$result["username"],$result["password"],$result["surname"],$result["lastname"],$result["permissionId"]));
            ?>
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>Oprávnění</h2>

                </div>
                <div class="container" style="width: 70%;">
                    <form method="post">
                    <table class="table">
                      <thead>
                        <tr>
                            <th>Id</th>
                             <th>Uživatelské jméno</th>
                             <th>Oprávnění</th>
                         </tr>
                     </thead>
                     <tbody>

                      <?php   foreach ($users as $user):
                      ?>
                          <tr>
                            <td><?= $user->getId(); ?></td>
                            <td><input type="hidden" value="<?=$user->getUsername();?>" name="username[]"><?= $user->getUsername(); ?></td>
                            <td>
                                <select class="form-select" aria-label="Default select example" name="permission<?=$user->getUsername();?>">
                                    <option <?= $user->getPermissionId() == 1 ? "selected" : "" ?> value="1">Uživatel</option>
                                    <option <?= $user->getPermissionId() == 2 ? "selected" : "" ?> value="2">Support</option>
                                    <option <?= $user->getPermissionId() == 3 ? "selected" : "" ?> value="3">Admin</option>
                                </select>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                     </tbody>
                    </table>
                    <input type="submit" name="submit" value="Uložit oprávnění" class="btn btn-dark" style="width: 100%">
                </div>
            <?php endif; ?>
        </main>
    </div>
</div>
<?php require("utils/footer.php"); ?>

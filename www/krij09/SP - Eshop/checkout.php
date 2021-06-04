<?php
session_start();
require("database/Db.php");
require("database/Dao.php");

$conn = new Db(DB_Server,DB_User,DB_Pass,DB_DB);
$conn->createConn();
$dao = new Dao($conn->getConn());
$price = 0;
$message = "";
$success = (object) array('bool' => true);

if(!isset($_SESSION['user']))
{
    header("Location: ./login.php");
    die;
}

if(!empty($_POST))
{
    if(isset($_POST['delete']))
    {
        $checkoutId = $_POST['checkoutId'];
        $success = $dao->deleteCheckout(new Checkout($checkoutId,"",unserialize($_SESSION['user'])->getId(),""), "delete");
        $message = $success->{'message'};
    }
    if(isset($_POST['up']))
    {
        $checkoutId = $_POST['checkoutId'];
        $success = $dao->updateCheckout($dao->fetchCheckoutById($checkoutId),"up");
        $message = $success->{'message'};

    }
    if(isset($_POST['down']))
    {
        $checkoutId = $_POST['checkoutId'];
        $success = $dao->updateCheckout($dao->fetchCheckoutById($checkoutId),"down");
        $message = $success->{'message'};

    }
    if(isset($_POST['cancel']))
    {
        $success = $dao->deleteCheckout(new Checkout("","",unserialize($_SESSION['user'])->getId(),""), "cancel");
        $message = $success->{'message'};
    }
}

?>
<?php require("utils/header.php"); ?>

<div class="container-fluid">
    <div class="row">
        <?php require("utils/side.php"); ?>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mb-5">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h2>Košík</h2>

            </div>
            <div class="alert-<?= $success->{'bool'} ? 'success' : 'danger' ?> text-center mb-4"><?=$message;?></div>

            <?php foreach($dao->fetchCheckoutByUserId(unserialize($_SESSION['user'])->getId()) as $item):
                $price += $item->getCount() * ($dao->fetchProductById($item->getGameId())->getPrice() / 100 * (100 - $dao->fetchProductById($item->getGameId())->getDiscount()));
                ?>
            <div class="card mb-2">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card-text px-lg-3">
                            <h3><?= $dao->fetchProductById($item->getGameId())->getTitle(); ?></h3>
                        </div>
                        <div class="card-text px-lg-4">
                            <?= $dao->fetchProductById($item->getGameId())->getDescription(); ?>
                        </div>
                    </div>
                    <div class="col-sm-2 d-flex justify-content-center align-items-center">
                        <?= $item->getCount() * ($dao->fetchProductById($item->getGameId())->getPrice() / 100 * (100 - $dao->fetchProductById($item->getGameId())->getDiscount())); ?> Kč
                    </div>
                    <div class="col-sm-2 d-flex justify-content-center align-items-center">
                        <p><?=$item->getCount(); ?></p>
                    </div>
                    <div class="col-sm-2">
                        <form method="post">
                            <input type="hidden" name="checkoutId" value="<?=$item->getCheckoutId();?>">
                            <button type="submit" name="up"><span data-feather="arrow-up"></span></button>
                        </form>
                        <form method="post">
                            <input type="hidden" name="checkoutId" value="<?=$item->getCheckoutId();?>">
                            <button type="submit" name="down"><span data-feather="arrow-down"></span></button>
                        </form>
                        <form method="post">
                            <input type="hidden" name="checkoutId" value="<?=$item->getCheckoutId();?>">
                            <button type="submit" name="delete"> <span data-feather="x"></span></button>
                        </form>

                    </div>
                </div>
            </div>
            <?php endforeach; ?>

            <div class="card mb-2">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card-text px-lg-3">
                            <h3>Součet</h3>
                        </div>
                    </div>
                    <div class="col-sm-2 d-flex justify-content-center align-items-center">
                        <?=$price; ?> Kč
                    </div>

                </div>
            </div>
            <form method="post">
            <div class="row">
                <div class="col-sm-4"></div>
            <div class="col-sm-2"><input style="width:100%" type="submit" value="Pokračovat"></div>

                    <div class="col-sm-2"><input style="width:100%" type="submit" name="cancel" value="Zrušit objednávku"></div>

                <div class="col-sm-4"></div>
            </div>
            </form>

        </main>
    </div>
</div>
<?php require("utils/footer.php"); ?>

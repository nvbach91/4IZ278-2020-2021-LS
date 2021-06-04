<?php
    session_start();
require("database/Db.php");
require("database/Dao.php");
?>
<?php require("utils/header.php"); ?>

<div class="container-fluid">
    <div class="row">
        <?php require("utils/side.php"); ?>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mb-5">
            <?php
            if(!isset($_GET['p']))
            {
                require("pages/index.php");
            }
            elseif ($_GET['p'] == "cat")
            {
                require("pages/categories.php");
            }
            elseif ($_GET['p'] == "item")
            {
                require("pages/item.php");
            }
            else
            {
                require("pages/error.php");
            }
            ?>

        </main>
    </div>
</div>
<?php require("utils/footer.php"); ?>

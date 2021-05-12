<?php
require "vendor/autoload.php";
session_start();

if (isset($_SESSION["flash"]))
{
    vprintf('<button type="button" class="btn btn-%s" disabled>%s</button>', $_SESSION["flash"]);
    unset($_SESSION["flash"]);
}

?>
<?php require './incl/header.php'; ?>

<main class="container-fluid">
    <div class="row">
        <div class="col-md-12 mt-5">
            <h1 class="text-center">MANGO SHOP</h1>
            <h3 class="text-center">shop with mangas, manhwas and comics</h3>
            <div class="row thumbnails">
                <div class="col-md-4 thumbnail comic">
                    <div class="thumbnail-text"><h2>Comic</h2></div>
                </div>
                <div class="col-md-4 thumbnail manga">
                    <div class="thumbnail-text"><h2>Manga</h2></div>
                </div>
                <div class="col-md-4 thumbnail manhwa">
                    <div class="thumbnail-text"><h2>Manhwa</h2></div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require './incl/footer.php'; ?>


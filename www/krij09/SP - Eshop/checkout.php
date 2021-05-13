<?php
session_start();
?>
<?php require("utils/header.php"); ?>

<div class="container-fluid">
    <div class="row">
        <?php require("utils/side.php"); ?>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mb-5">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h2>Produktyyyy</h2>

            </div>
            <div class="card mb-2">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="card-text px-lg-3">
                            <h3>Witcher 3</h3>
                        </div>
                        <div class="card-text px-lg-4">
                            Tvoje máma AHAHAAHAAH
                        </div>
                    </div>
                    <div class="col-sm-2 d-flex justify-content-center align-items-center">
                        999.99 Kč
                    </div>
                    <div class="col-sm-2">
                        <p>1</p>
                        <span data-feather="arrow-up"></span>
                        <span data-feather="arrow-down"></span>
                        <span data-feather="x"></span>
                    </div>
                </div>
            </div>            <div class="card mb-2">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="card-text px-lg-3">
                            <h3>Witcher 3</h3>
                        </div>
                        <div class="card-text px-lg-4">
                            Tvoje máma AHAHAAHAAH
                        </div>
                    </div>
                    <div class="col-sm-2 d-flex justify-content-center align-items-center">
                        999.99 Kč
                    </div>
                    <div class="col-sm-2">
                        <p>1</p>
                        <span data-feather="arrow-up"></span>
                        <span data-feather="arrow-down"></span>
                        <span data-feather="x"></span>
                    </div>
                </div>
            </div>

            <div class="card mb-2">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="card-text px-lg-3">
                            <h3>Součet</h3>
                        </div>
                    </div>
                    <div class="col-sm-2 d-flex justify-content-center align-items-center">
                        1998 Kč
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-sm-4"></div>
            <div class="col-sm-2"><input style="width:100%" type="submit" value="Pokračovat"></div>
            <div class="col-sm-2"><input style="width:100%" type="submit" value="Zrušit objednávku"></div>
                <div class="col-sm-4"></div>
            </div>


        </main>
    </div>
</div>
<?php require("utils/footer.php"); ?>

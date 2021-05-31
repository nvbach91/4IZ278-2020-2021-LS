<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Fíčured kategorís</h1>

</div>
<?php
$conn = new Db(DB_Server,DB_User,DB_Pass,DB_DB);
$conn->createConn();
$dao = new Dao($conn->getConn());
$cate = $dao->fetchCategories();
$random = array_rand($cate);
?>
<div class="row">
    <div class="col">
        <div class="card shadow-sm">
            <img src="<?=$cate[$random]->getImg();?>" class="bd-placeholder-img card-img-top">
            <div class="card-body">
                <h6 class="card-header"><?= $cate[$random]->getName()?></h6>
                <p class="card-text mt-1"><?= $cate[$random]->getDescription()?></p>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                        <a href="index.php?p=cat&c=<?= $cate[$random]->getCategoryId(); ?>"><button type="button" class="btn btn-sm btn-outline-secondary">Zobrazit kategorii</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card shadow-sm">
            <img src="https://i.imgur.com/xRFlG27.png" class="bd-placeholder-img card-img-top">

            <div class="card-body">
                <h6 class="card-header">Zlevněné produkty</h6>
                <p class="card-text mt-1">Zlevněné produkty, slevy až 75%!</p>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                        <a href="index.php?p=cat&c=sale"><button type="button" class="btn btn-sm btn-outline-secondary">Zobrazit kategorii</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card shadow-sm">
            <?php
            unset($cate[$random]);
            $random = array_rand($cate);
            ?>
            <img src="<?=$cate[$random]->getImg();?>" class="bd-placeholder-img card-img-top">
            <div class="card-body">
                <h6 class="card-header"><?= $cate[$random]->getName()?></h6>
                <p class="card-text mt-1"><?= $cate[$random]->getDescription()?></p>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                        <a href="index.php?p=cat&c=<?= $cate[$random]->getCategoryId(); ?>"><button type="button" class="btn btn-sm btn-outline-secondary">Zobrazit kategorii</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2>Fíčured produkts</h2>

</div>
<style>
    .card img{
        max-height: 300px!important;
    }
</style>
<?php

$prod = $dao->fetchProduct();
$random = array_rand($prod);

?>
<div class="row">
    <div class="col">
        <div class="card shadow-sm">
            <img src="<?=$prod[$random]->getImg();?>" class="bd-placeholder-img card-img-top">

            <div class="card-body">
                <h6 class="card-header"><?=$prod[$random]->getTitle(); ?></h6>
                <p class="card-text mt-1"><?=$prod[$random]->getDescription(); ?></p>
                <div class="d-flex justify-content-between align-items-center">
                    <a href="?p=item&i=<?=$prod[$random]->getGameId(); ?>">
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-outline-secondary">Podrobnosti</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary"><span data-feather="shopping-cart"></span></button>
                        </div>
                    </a>
                    <small>
                        <span class="p-1" <?= $prod[$random]->getDiscount() != 0 ? "style='text-decoration:line-through;'" : "style='display:none'" ?>>
                            <?= $prod[$random]->getPrice(); ?> Kč
                        </span>
                        <span <?= $prod[$random]->getDiscount() != 0 ? "style='color:red;'" : "" ?>>
                            <?= $prod[$random]->getPrice() / 100 * (100 - $prod[$random]->getDiscount()); ?> Kč
                        </span>
                    </small>
                </div>
            </div>
        </div>
    </div>
    <?php unset($prod[$random]);
    $random = array_rand($prod); ?>
    <div class="col">
        <div class="card shadow-sm">
            <img src="<?=$prod[$random]->getImg();?>" class="bd-placeholder-img card-img-top">

            <div class="card-body">
                <h6 class="card-header"><?=$prod[$random]->getTitle(); ?></h6>
                <p class="card-text mt-1"><?=$prod[$random]->getDescription(); ?></p>
                <div class="d-flex justify-content-between align-items-center">
                    <a href="?p=item&i=<?=$prod[$random]->getGameId(); ?>">
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-outline-secondary">Podrobnosti</button>
                        <button type="button" class="btn btn-sm btn-outline-secondary"><span data-feather="shopping-cart"></span></button>
                    </div>
                    </a>
                    <small>
                        <span class="p-1" <?= $prod[$random]->getDiscount() != 0 ? "style='text-decoration:line-through;'" : "style='display:none'" ?>>
                            <?= $prod[$random]->getPrice(); ?> Kč
                        </span>
                        <span <?= $prod[$random]->getDiscount() != 0 ? "style='color:red;'" : "" ?>>
                            <?= $prod[$random]->getPrice() / 100 * (100 - $prod[$random]->getDiscount()); ?> Kč
                        </span>
                    </small>
                </div>
            </div>
        </div>
    </div>
    <?php unset($prod[$random]);
    $random = array_rand($prod); ?>
    <div class="col">
        <div class="card shadow-sm">
            <img src="<?=$prod[$random]->getImg();?>" class="bd-placeholder-img card-img-top">

            <div class="card-body">
                <h6 class="card-header"><?=$prod[$random]->getTitle(); ?></h6>
                <p class="card-text mt-1"><?=$prod[$random]->getDescription(); ?></p>
                <div class="d-flex justify-content-between align-items-center">
                    <a href="?p=item&i=<?=$prod[$random]->getGameId(); ?>">
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-outline-secondary">Podrobnosti</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary"><span data-feather="shopping-cart"></span></button>
                        </div>
                    </a>
                    <small>
                        <span class="p-1" <?= $prod[$random]->getDiscount() != 0 ? "style='text-decoration:line-through;'" : "style='display:none'" ?>>
                            <?= $prod[$random]->getPrice(); ?> Kč
                        </span>
                        <span <?= $prod[$random]->getDiscount() != 0 ? "style='color:red;'" : "" ?>>
                            <?= $prod[$random]->getPrice() / 100 * (100 - $prod[$random]->getDiscount()); ?> Kč
                        </span>
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

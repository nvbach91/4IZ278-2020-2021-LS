<?php
$conn = new Db(DB_Server,DB_User,DB_Pass,DB_DB);
$conn->createConn();
$dao = new Dao($conn->getConn());

?>
<style>
    .fifty-chars {
        width: 35ch;
        min-height: 100px;
        max-height: 100px;
        overflow: auto;
        white-space: normal;
        text-overflow: ellipsis;
    }
</style>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1>
        <?php
        if($_GET['c'] == "all")
            echo "Všechny produkty";
        elseif($_GET['c'] == "sale")
            echo "Zlevněné produkty";
        else
            echo $dao->getCategoryById($_GET['c'])->getName();
        ?>
    </h1>
</div>
<div class="container">
<div class="row">
    <?php
    $products = $_GET['c'] == "all" || $_GET['c'] == "sale" ? $dao->fetchProduct() : $dao->fetchProductByCategory($_GET['c']);
    if($products != [])
    foreach($products as $product):
        if($_GET['c'] == "sale" && $product->getDiscount() == 0)
        {
            continue;
        }
        ?>
        <div class="col mb-4">
            <div class="card shadow-sm">
                <div class="text-center">
                    <img src="<?=$product->getImg(); ?>"  class="img-thumbnail card-img-top" style="width: 200px; height: 200px">
                </div>
                <div class="card-body">
                    <h6 class="card-header"><?=$product->getTitle(); ?></h6>
                    <p class="card-text mt-1 fifty-chars"><?=$product->getDescription(); ?></p>
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="?p=item&i=<?=$product->getGameId(); ?>">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-outline-secondary">Podrobnosti</button>
                                <button type="button" class="btn btn-sm btn-outline-secondary"><span data-feather="shopping-cart"></span></button>
                            </div>
                        </a>
                        <small>
                        <span class="p-1" <?= $product->getDiscount() != 0 ? "style='text-decoration:line-through;'" : "style='display:none'" ?>>
                            <?= $product->getPrice(); ?> Kč
                        </span>
                            <span <?= $product->getDiscount() != 0 ? "style='color:red;'" : "" ?>>
                            <?= $product->getPrice() / 100 * (100 - $product->getDiscount()); ?> Kč
                        </span>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; else echo('Kategorie nebyla nalezena.'); ?>
</div>
</div>

<?php
require_once "db/ProductsDB.php";
require_once "db/CategoriesDB.php";
require "incl/header.php";

$prodDB = new productsDB();
if ("POST" == $_SERVER['REQUEST_METHOD']) {
    if (!isset($_SESSION["cart"])) {
        $_SESSION["cart"] = [];
    }
    foreach ($_POST as $key => $value) {
        if ($key[0] === "b") {
            $id = $key[1];
            $amount = $_POST["i" . $id];
            break;
        }
        if ($key[0] === "c") {
            $id = $key[1];
            $prodDB->deleteItems("ID", $id);
            break;
        }
    }
    if (isset($amount)) {
        $needs_add_new = true;
        foreach ($_SESSION["cart"] as $key2 => $item) {
            if ($id == $item["id"]) {
                (string)$_SESSION["cart"][$key2]["amount"] = (int)$_SESSION["cart"][$key2]["amount"] + (int)$amount;
                $needs_add_new = false;
                break;
            }
        }
        if ($needs_add_new)
            array_push($_SESSION["cart"], ["id" => $id, "amount" => $amount]);
    }

}

if (isset($_GET['offset'])) {
    $currentPagination = (int)$_GET['offset'];
} else {
    $currentPagination = 1;
}
if (isset($_GET['category'])) {
    $cat = $_GET['category'];
} else {
    $cat = -1;
}
//fetches products
$products = $prodDB->fetchAll();
$productsPerPage = 6;
if ($cat != -1) {
    $helpArray = [];
    foreach ($products as $key => $product) {
        if ($product["fk_category"] == $cat) {
            array_push($helpArray, $product);
        }
    }
    $products = $helpArray;
}

//var_dump($products);

$numberOfPaginations = ceil(sizeOf($products) / $productsPerPage);
$products = array_slice($products, $productsPerPage * ($currentPagination - 1), $productsPerPage * ($currentPagination));

//gets category name
require "incl/navbar.php";
?>
<main class="container" style="text-align:center">
    <H1>E-shop</H1>
    <div class="row">
        <div class="col-lg-2">
            <?php require __DIR__ . '/components/CategoryDisplay.php'; ?>
        </div>
        <div class="col-lg-9" style="display: flex; flex-direction: column">
            <?php require __DIR__ . '/components/PaginationDisplay.php'; ?>
            <?php require __DIR__ . '/components/ProductDisplay.php'; ?>
            <?php require __DIR__ . '/components/PaginationDisplay.php'; ?>
        </div>
    </div>
</main>
<?php
require "incl/footer.php";
?>


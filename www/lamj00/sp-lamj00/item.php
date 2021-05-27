<?php
require "incl/header.php";
require "incl/navbar.php";
require_once "db/productsDB.php";
if(!isset($_GET["ID"])) header("location: index.php");
$prodDB = new productsDB;
$product = $prodDB ->getItem("ID",(int)$_GET["ID"]);

?>

<main class="container">
    <div class="card mb-3" >
        <div class="row g-0">
            <div class="col-md-4">
                <img class="card-img"
                     src="<?php echo "img/products/" . $product['product_name'] . ".jpg"; ?>"
                     alt="<?php echo $product['product_name']; ?>">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <H1><?php echo $product["product_name"]?></H1>
                    <h3><?php echo number_format($product['price'], 2), ' ', "$"; ?></h3>
                    <h4><?php echo $product["description"]?></h4>

                </div>
            </div>
        </div>
    </div>



</main>
<?php
require  "incl/footer.php";
?>



<?php
require "incl/header.php";
require "incl/navbar.php";
require_once "db/ProductsDB.php";
require_once "db/CategoriesDB.php";
require "functions/adminRequired.php";
$invalidInputs = [];
$prodDB = new ProductsDB();
$catDB = new CategoriesDB();

if ('POST' == $_SERVER['REQUEST_METHOD']) {
    $productName = $_POST['productName'];
    $description = $_POST['description'];
    $price = $_POST["price"];
    $category = $_POST["category"];
    if(empty($productName)) array_push($invalidInputs,"Name not set");
    if(empty($description)) array_push($invalidInputs,"Description not set");
    if(empty($price)) array_push($invalidInputs,"Price not set");
    if(empty($invalidInputs)) $prodDB ->addItem([$productName,$description,$price,$category]);
}
?>
<main class="cont">
    <h1 class="text-center">Log in</h1>
    <?php foreach($invalidInputs as $msg):?>
        <div class="alert alert-danger" role="alert"><?php echo $msg;?></div>
    <?php endforeach; ?>
    <form class="form-login" method="POST" action="">

        <div class="form-group">
            <label>Product name</label>
            <input class="form-control" name="productName" placeholder="Product name" value="<?php echo $productName ?? '' ?>">
        </div>
        </br>
        <div class="form-group">
            <label>Description</label>
            <input class="form-control" name="description" placeholder="Description" value="<?php echo $description ?? '' ?>">
        </div>
        <br>
        <div class="form-group">
            <label>Price</label>
            <input class="form-control" name="price" placeholder="price" value="<?php echo $price ?? '' ?>">
        </div>
        <br>
        <label>Categories</label>
        <div class="input-group">
            <select name="category" class="form-select">
                <?php foreach ($catDB->fetchAll()as $item){
                    echo "<option  value='".$item["ID"]."'>".$item["category_name"]."</option>";
                }?>
            </select>
        </div>
        <br>
        <button class="btn btn-primary" type="Login">Create product</button>
    </form>

</main>
<?php
require  "incl/footer.php";
?>


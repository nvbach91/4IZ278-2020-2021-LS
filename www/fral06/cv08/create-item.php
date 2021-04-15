<?php
require __DIR__ . "/model/ProductsDB.php";

$productDb = new ProductsDB();

$errors = array();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $madeIn = $_POST['made_in'];
    $url = $_POST['url'];
    if (isset($name) && isset($price) && isset($madeIn) && isset($url)) {
        if (strlen($name) < 1) {
            array_push($errors, "Product has to have at least 1 character");
        }
        else if (strlen($madeIn) < 2) {
            array_push($errors, "Country has to have at least 2 character");
        }

        else if (($price) <= 0) {
            array_push($errors, "Price has to have be greater than zero");
        }
        else {
            $productDb->insertInto($name, $price, $madeIn, $url);
            header('Location: index.php');
            exit();
        }
    }
}

//head
include "includes/head.php";
//Navigation
include "includes/navigation.php"
?>
<main class="container signin">
    <div class="signin__wrapper ">
        <h1 class="text-center mb-3">Add item</h1>
        <form method="POST">
            <div class="form-group">
                <label for="name">Name</label>
                <input class="form-control" id="name" type="text" name="name" placeholder="Name">
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input class="form-control" id="price"  type="number" name="price" placeholder="Name">
            </div>
            <div class="form-group">
                <label for="url">Image link</label>
                <input class="form-control" id="urk"  type="url" name="url" placeholder="Name">
            </div>
            <div class="form-group">
                <label for="made_in">Country of origin</label>
                <input class="form-control" id="made_in"  type="text" name="made_in" placeholder="Name">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</main>


<?php
//Footer
include "includes/footer.php";
//Foot
include "includes/foot.php";
?>


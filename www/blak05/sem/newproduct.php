<?php
    session_start();
    $_SESSION["location"] = "newproduct";
?>
<?php require __DIR__ . '/incl/header.php'; ?>
<?php require __DIR__ . '/incl/navbar.php'; ?>
<?php require __DIR__ . '/incl/auth.php'; ?>
<?php require __DIR__ . '/db/beersDB.php' ?>
<?php
    $error = "";
    if (!empty($_POST)) {

        $name = $_POST['name'];
        $brand = $_POST['brand'];
        $shortbrand = $_POST['shortbrand'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $stock = $_POST['stock'];
        $id_category = $_POST['catid'];
        $image = $_POST['image'];
        
        $newproduktDB = new BeersDB();
        $produkt = $newproduktDB->create([$name, $brand, $shortbrand, $description, $price, $stock, $id_category, $image]);
        header("Location: beers.php");
    }
?>
<main>
    <div class="container blog text-center">
        <h1>Přidat nové pivo</h1>
        <form action="#" method="POST" class="row g-3">
        <div class="col-4">
            <label for="name" class="form-label">Název</label>
            <input type="text" class="form-control" name="name" placeholder="">
        </div>
        <div class="col-4">
            <label for="brand" class="form-label">Značka</label>
            <input type="text" class="form-control" name="brand" placeholder="">
        </div>
        <div class="col-4">
            <label for="shortbrand" class="form-label">Short Brand</label>
            <input type="text" class="form-control" name="shortbrand" placeholder="">
        </div>
        <div class="col-12">
            <label for="description" class="form-label">Popis</label>
            <textarea type="text" class="form-control" name="description"></textarea>
        </div>
        <div class="col-md-1">
            <label for="price" class="form-label">Price</label>
            <input type="text" class="form-control" name="price" placeholder="">
        </div>
        <div class="col-md-1">
            <label for="stock" class="form-label">Stock</label>
            <input type="text" class="form-control" name="stock" placeholder="">
        </div>
        <div class="col-md-1">
            <label for="id_category" class="form-label">ID Category</label>
            <select class="form-select" name="catid" aria-label="Default select example">
                <?php require __DIR__ . '/db/categoriesDB.php'; ?>
                <?php
                    $categoriesDB = new CategoriesDB();
                    $categories = $categoriesDB->fetchAll();
                ?> 
                <?php foreach($categories as $category): ?>
                    <option value="<?php echo $category['id_category']?>"><?php echo $category['cat_name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-9">
            <label for="image" class="form-label">Image</label>
            <input type="text" class="form-control" name="image" placeholder="">
        </div>
        <div class="col-12">
            <button class="btn btn-lg btn-outline-dark btn-warning btn-block" type="submit">Uložit novou verzi</button>
        </div>
        </form>
    </div>
</main>
<?php require __DIR__ . '/incl/footer.php'; ?>
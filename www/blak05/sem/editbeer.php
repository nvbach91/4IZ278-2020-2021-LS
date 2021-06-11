<?php
    session_start();
    $_SESSION["location"] = "edit";
?>
<?php require __DIR__ . '/incl/header.php'; ?>
<?php require __DIR__ . '/incl/navbar.php'; ?>
<?php 
    require __DIR__ . '/incl/auth.php';
    require __DIR__ . '/db/beersDB.php'; 

    if (!empty($_GET)) {
        $cislo = $_GET["id"];
        $beersDB = new BeersDB();
        $beer = $beersDB->fetchBrew($cislo);

        if(!empty($_POST)){
            $name = $_POST['name'];
            $brand = $_POST['brand'];
            $shortbrand = $_POST['shortbrand'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $stock = $_POST['stock'];
            $id_category = $_POST['catid'];
            $image = $_POST['image'];
            $updateDB = new BeersDB();
            $update = $updateDB->update([$name, $brand, $shortbrand, $description, $price, $stock, $id_category, $image, $cislo]);
            Header("Location: beers.php");
        }
    }else{
        Header("Location: index.php");
    }

?>
<main>
    <div class="container blog text-center">
        <h1>Editovat pivo <?php echo $_GET["id"]?>.</h1>
        <form action="#" method="POST" class="row g-3">
            <div class="col-4">
                <label for="name" class="form-label">Název</label>
                <input type="text" class="form-control" name="name" value="<?php echo $beer['name'];?>">
            </div>
            <div class="col-4">
                <label for="brand" class="form-label">Značka</label>
                <input type="text" class="form-control" name="brand" value="<?php echo $beer['brand'];?>">
            </div>
            <div class="col-4">
                <label for="shortbrand" class="form-label">Short Brand</label>
                <input type="text" class="form-control" name="shortbrand" value="<?php echo $beer['shortbrand'];?>">
            </div>
            <div class="col-12">
                <label for="description" class="form-label">Popis</label>
                <textarea type="text" class="form-control" name="description"><?php echo $beer['description'];?></textarea>
            </div>
            <div class="col-md-1">
                <label for="price" class="form-label">Price</label>
                <input type="text" class="form-control" name="price" value="<?php echo $beer['price'];?>">
            </div>
            <div class="col-md-1">
                <label for="stock" class="form-label">Stock</label>
                <input type="text" class="form-control" name="stock" value="<?php echo $beer['stock'];?>">
            </div>
            <div class="col-md-2">
                <label for="stock" class="form-label">ID Kategorie</label>
                <select class="form-select" name="catid" aria-label="Default select example">
                    <?php require __DIR__ . '/db/categoriesDB.php'; ?>
                    <?php
                        $categoriesDB = new CategoriesDB();
                        $categories = $categoriesDB->fetchAll();
                    ?> 
                    <?php foreach($categories as $category): ?>
                        <?php if($category['id_category']==$beer['id_category']):?>
                            <option value="<?php echo $category['id_category']?>" selected><?php echo $category['cat_name'] ?></option>
                        <?php else: ?>
                            <option value="<?php echo $category['id_category']?>"><?php echo $category['cat_name'] ?></option>
                        <?php endif ?>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-8">
                <label for="image" class="form-label">Image</label>
                <input type="text" class="form-control" name="image" value="<?php echo $beer['image'];?>">
            </div>
            <div class="col-12">
                <button class="btn btn-lg btn-outline-dark btn-warning btn-block" type="submit">Uložit novou verzi</button>
            </div>
        </form>
    </div>
</main>
<?php require __DIR__ . '/incl/footer.php'; ?>
<?php require __DIR__ . '/../db/beersDB.php'; ?>
<?php
    if(!empty($_GET['id_category'])){
        $id = $_GET['id_category'];
        $beersDB = new BeersDB();
        $beers = $beersDB->fetchCategories($id);
    }elseif(!empty($_GET['brand'])){
        $brand = $_GET['brand'];
        $beersDB = new BeersDB();
        $beers = $beersDB->fetchBrand($brand);
    }else{
        $beersDB = new BeersDB();
        $beers = $beersDB->fetchAll();
    }
?>
    <?php foreach($beers as $beer): ?>
        <div class="col-md-3">
            <a href="beer.php?id=<?php echo $beer['id_product']?>" class="link-dark text-decoration-none">   
                <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-240 position-relative">
                    <div class="col p-4 d-flex flex-column position-static">
                        <h4 class="mb-0"><?php echo $beer['name']; ?></h4>
                        <div class="mb-1 text-muted">Dostupných <?php echo $beer['stock']; ?> kusů</div>
                        <strong class="d-inline-block text-warning"><?php echo $beer['cat_name']; ?></strong>
                    </div>
                    <div class="col-auto d-none d-lg-block pb-2" style="margin: 0 auto;">
                        <img height="300px" width="110x" src="<?php echo $beer['image']; ?>">
                    </div>
                    <div class="col-md-12">
                        <?php if($beer['stock']<1):?>
                            <button type="button" class="btn btn-dark mb-2" disabled>Momentálně vyprodáno</button></a>
                        <?php else:?>
                        <a href="buy.php?id=<?php echo $beer['id_product']; ?>"><button type="button" class="btn btn-dark mb-2"><?php echo $beer['price']; ?> Kč</button></a>
                        <?php endif ?>
                    </div>
                </div>
            </a>
        </div>
    <?php endforeach; ?>
    

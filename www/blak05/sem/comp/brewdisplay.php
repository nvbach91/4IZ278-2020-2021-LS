<?php require __DIR__ . '/../db/beersDB.php'; ?>
<?php
        $brewDB = new BeersDB();
        $brews = $brewDB->fetchAllBrew();
?>
    <?php foreach($brews as $brew): ?>
        <div class="col-md-3">
            <a href="nastroj-<?php echo $brew['id_product']?>-<?php echo $brew['name']?>" class="link-dark text-decoration-none">   
                <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-240 position-relative">
                    <div class="col p-4 d-flex flex-column position-static">
                        <h4 class="mb-0"><?php echo $brew['name']; ?></h4>
                        <div class="mb-1 text-muted">Dostupných <?php echo $brew['stock']; ?> kusů</div>
                    </div>
                    <div class="col-auto d-none d-lg-block pb-2" style="margin: 0 auto;">
                        <img height="300px" width="110x" src="<?php echo $brew['image']; ?>">
                    </div>
                    <div class="col-md-12">
                        <?php if($brew['stock']<1):?>
                            <button type="button" class="btn btn-dark mb-2" disabled>Momentálně vyprodáno</button></a>
                        <?php else:?>
                        <a href="buy.php?id=<?php echo $brew['id_product']; ?>"><button type="button" class="btn btn-dark mb-2"><?php echo $brew['price']; ?> Kč</button></a>
                        <?php endif ?>
                    </div>
                </div>
            </a>
        </div>
    <?php endforeach; ?>
    

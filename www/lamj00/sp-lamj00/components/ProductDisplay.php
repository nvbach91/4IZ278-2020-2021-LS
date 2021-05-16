<div class="row">
    <?php if (!empty($products)) {
        foreach ($products as $product):
            if ($cat == -1) {

            } elseif (!($product["fk_category"] == $cat)) {
                return;
            }
            ?>
            <div class="col-lg-4" style="max-width: 500px;margin-bottom: 1rem">
                <a href="product.php?product=<?php echo $product['product_name']; ?>">
                    <div class="card h-100 ">

                        <a href="#" style="text-align: center">
                            <img class="card-img "
                                 style="height: 200px; width: 200px;margin: 15px"
                                 src="<?php echo "img/products/" . $product['product_name'] . ".png"; ?>"
                                 alt="<?php echo $product['product_name']; ?>">
                        </a>
                        <div class="card-body d-flex .card-body flex-column mt-auto">
                            <h4 class="card-title" style="text-align: right">
                                <a href="product.php?product=<?php echo $product['product_name']; ?>"><?php echo $product['product_name']; ?></a>
                            </h4>
                            <h5 style="text-align: right"><?php echo number_format($product['price'], 2), ' ', "$"; ?></h5>
                            <p class="card-text" style="text-align: left"><?php echo $product['description']; ?></p>
                            <div style="display: flex;margin-top:auto;">
                                <div style="flex-grow: 1"></div>
                                <div class="input-group mb-sm-1">
                                    <input type="text" class="form-control"  aria-describedby="button-addon2">
                                    <button class="btn btn-outline-primary" type="button" id="button-addon2">Button</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </a>

            </div>
        <?php endforeach;
    } ?>
</div>
<form action="" method="POST" name="theForm" id="theForm">
<div class="row">
    <?php if (!empty($products)) {
        foreach ($products as $product):
            if ($cat == -1) {

            } elseif (!($product["fk_category"] == $cat)) {
                return;
            }
            ?>
            <div class="col-lg-4" style="max-width: 500px;margin-bottom: 1rem; justify-content: center">
                <a href="item.php?ID=<?php echo $product['ID']; ?>" style="align-self: center">
                    <div class="card h-100 ">

                        <a href="item.php?ID=<?php echo $product['ID']; ?>" style="text-align: center">
                            <img class="card-img "
                                 style="height: 200px; width: 200px;margin: 15px"
                                 src="<?php echo "img/products/" . $product['product_name'] . ".jpg"; ?>"
                                 alt="<?php echo $product['product_name']; ?>">
                        </a>
                        <div class="card-body d-flex .card-body flex-column mt-auto">
                            <h4 class="card-title" style="text-align: right">
                                <a href="item.php?ID=<?php echo $product['ID']; ?>"><?php echo $product['product_name']; ?></a>
                            </h4>
                            <h5 style="text-align: right"><?php echo number_format($product['price'], 2), ' ', "$"; ?></h5>
                            <p class="card-text" style="text-align: left"><?php echo $product['description']; ?></p>
                            <div style="display: flex;margin-top:auto;">
                                <div style="flex-grow:1;"></div>
                                <div class="input-group mb-sm-1" style="width: 100px;">
                                    <input type="text"
                                           name="<?php echo "i".$product['ID'] ?>"
                                           class="form-control"
                                           aria-describedby="button-addon2"
                                           value="1"  >
                                    <button class="btn btn-outline-primary" name="<?php echo "b".$product['ID'] ?>" type="submit" id="button-addon2">
                                        BUY
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                </a>

            </div>
        <?php endforeach;
    } ?>
</div>
</form>
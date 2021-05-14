<?php require_once __DIR__ . '/class/ProductsDB.php'; ?>
<?php


$productDB = new ProductsDB();
$products = $productDB->cart();
$sum = $productDB->getSumOfProducts();


?>


<?php include __DIR__ . '/includes/header.php' ?>

<body>
    <div class="container">

        <h1 style="margin-top:20px;">My shopping cart</h1>
        Total products selected:
        <?php if (empty($products)) {
            echo "0";
        } else {
            echo count($products);
        };
        ?>
        <br><br>
        <a class="primary-btn" href="index.php">Back to the shop</a>
        <br><br>
        <h3 style="margin-bottom:10px">Celkem: <?php echo round($sum, 2); ?> Kč</h3>


        <table class="tbl-cart" cellpadding="10" cellspacing="1">
				<tbody>
					<tr>
                        <th style="text-align:left;" width="10%">Image</th>
                        <th style="text-align:left;">Name</th>
                        <th style="text-align:center;" width="10%">Unit Price</th>
						<th style="text-align:center;" width="5%">Quantity</th>
	
						<th style="text-align:center;" width="10%">Price</th>
						<th style="text-align:center;" width="5%">Remove</th>
					</tr>

        <?php if (@$products) : ?>
            <div class="products">
                <div class="row">
                    <?php foreach ($products as $product) : ?>
                        <? $product_price = $product["price"];?>
                        <tr>
                            <td ><img src="<?php echo $product["img"]; ?>" class="cart-item-image"/></td>
                            <td style="text-align:left;"><?php echo $product["name"]; ?></td>
                            <td style="text-align:right;"><?php echo  $product["price"] . " Kč ";?></td>
							<td style="text-align:right;">1</td>

							<td style="text-align:right;"><?php echo number_format($product_price, 2) .  " Kč"; ?></td>
							<td style="text-align:center;"><a href="remove-item.php?id=<?php echo $product['product_id']; ?>"class="btnRemoveAction"><i style="font-size: 20px;" class="fa fa-trash"></i></a></td>
                        </tr>
                        <?php
           
                        ?>
					<?php endforeach;?>
                        <tr>
						<td colspan="2" align="right">Total:</td>
						<td align="right"></td>
						<td align="right" colspan="2"><strong><?php ?></strong></td>
						<td></td>
                    </tr>
                    
				</tbody>
			</table>
                    <?php else:?>
			<div class="no-records">Your Cart is Empty</div>
		<?php
		endif
        ?>

                         
    </div>

    <?php include __DIR__ . '/includes/footer.php' ?>
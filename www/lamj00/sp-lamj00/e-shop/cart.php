<?php
require "incl/header.php";
require "incl/navbar.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $i = (array_key_first($_POST));
    unset($_SESSION["cart"][$i]);
    $_SESSION["cart"] = array_values($_SESSION["cart"]);
}
require "functions/getItems.php";

?>


<main class="container">
    <H1>Cart</H1>
    <div>
        <table class="table table-light">
            <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col">Product name</th>
                <th scope="col">Amount</th>
                <th scope="col" style="text-align: right; padding-right: 80px;">Price</th>
            </tr>
            </thead>
            <tbody>
            <form action="" method="POST" name="theForm" id="theForm">
                <?php foreach ($cart2 as $index => $item): ?>
                    <tr>
                        <td style="width: 80px">
                            <button form="theForm" class="btn btn-danger" name="<?php echo $index; ?>" type="submit">
                                Delete item
                            </button>
                        </td>
                        <td style="text-align: center">
                            <img class="card-img "
                                 style="height: 80px; width: 80px;"
                                 src="<?php echo "img/products/" . $item['product_name'] . ".jpg"; ?>"
                                 alt="<?php echo $item['product_name']; ?>">
                        </td>
                        <td><?php echo $item['product_name']; ?></td>
                        <td><?php echo number_format($item['amount'], 2), ' ', "$"; ?></td>
                        <td style="text-align: right; padding-right: 80px;"><?php echo number_format($item['price'], 2), ' ', "$"; ?></td>
                    </tr>
                <?php endforeach; ?>
            </form>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td style="text-align: right; padding-right: 80px;">
                    Total: <?php echo number_format($total, 2), ' ', "$"; ?></td>
            </tr>
            </tbody>
        </table>

    </div>
    <div class="d-grid gap-2">
        <button class="btn btn-primary" type="button" style="font-size:  2rem;"><a href="createOrder.php">Continue
                creating order</a></button>

    </div>
</main>
<?php
require "incl/footer.php";
?>



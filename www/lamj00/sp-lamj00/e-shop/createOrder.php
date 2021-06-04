<?php
require "incl/header.php";
require "incl/navbar.php";
require_once "db/Profile.php";
require_once "db/OrdersDB.php";
$ordDB = new OrdersDB();
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $name = $_POST["name"];
    $address = $_POST["address"];
    header("location:orderCreated.php?name=$name&address=$address");
}
$profile = new Profile($_SESSION["user_id"]);
require "functions/getItems.php";
?>


<main class="container" style="text-align: center">
    <div class="cont">
        <H1>Confirm order information</H1>
        <h3>Basic order information</h3>
        <form action="" method="POST">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Order ID</th>
                <th scope="col">Name</th>
                <th scope="col">Address</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><?php echo $ordDB->getNextID() ?></td>
                <td><input name="name" value="<?php echo $profile->getFirstName() . " " . $profile->getLastName() ?>"></td>
                <td><input name="address"  value="<?php echo $profile->getAddress() ?>"></td>
            </tr>
            </tbody>
        </table>
        <H3>Order items</H3>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Product</th>
                <th scope="col">Quantity</th>
                <th scope="col">Price</th>
                <th scope="col">Total price</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($cart2 as $item): ?>
                <tr>
                    <td><?php echo $item["product_name"] ?></td>
                    <td><?php echo $item["amount"] ?></td>
                    <td><?php echo number_format($item["price"], 2), ' ', "$"; ?></td>
                    <td><?php echo number_format($item["price"] * $item["amount"], 2), ' ', "$"; ?></td>
                </tr>

            <?php endforeach; ?>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td style="text-align: right; padding-right: 80px;">
                    Total: <?php echo number_format($total, 2), ' ', "$"; ?></td>
            </tr>
            </tbody>
        </table>
        <div>
            <button class="btn btn-primary" type="submit">Create order</button>
        </div>
        </form>
    </div>
</main>
<?php
require "incl/footer.php";
?>



<?php
session_start();
require_once "db/Order.php";
require_once "db/OrdersDB.php";
require_once "db/UsersDB.php";
require_once "functions/createInvoice.php";
require_once "functions/sendMail.php";
$ordDB = new OrdersDB();
$userDB = new UsersDB();
$order = new Order();
$order->writeData();

$address = $_GET["name"] . "\n" . $_GET["address"];
$ordDB->updateItem($order->getId(), "address", $address);
$id = $order->getId();
$order = new Order();
$order->gatherData($id);
$products = $order->getProducts();
$id = $order->getId();
$date = $order->getDate();
$total = $order->getTotal();
$address = $order->getAddress();
$user = $userDB ->getItem("ID",$_SESSION["user_id"]);
createInvoice($order,$user,$products);
$body = "You invoice is in the attachment";
sendMail($user["email"],"Your order have been processed",$body,"invoice.pdf");
$_SESSION["cart"] = [];
require "incl/header.php";
require "incl/navbar.php";
?>
<main class="container" style="text-align: center">
    <div class="cont">
        <H1>Order has been created</H1>
        <h3>Basic order information</h3>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Order ID</th>
                <th scope="col">Date</th>
                <th scope="col">Address</th>
                <th scope="col">Total price</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><?php echo $id ?></td>
                <td><?php echo $date ?></td>
                <td><?php echo $address ?></td>
                <td><?php echo number_format($total, 2), ' ', "$"; ?></td>
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
            <?php foreach ($products as $item): ?>
                <tr>
                    <td><?php echo $item["product_name"] ?></td>
                    <td><?php echo $item["quantity"] ?></td>
                    <td><?php echo number_format($item["price"], 2), ' ', "$"; ?></td>
                    <td><?php echo number_format($item["price"] * $item["quantity"], 2), ' ', "$"; ?></td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            </tbody>
        </table>
        <div>
            <button class="btn btn-primary" type="submit"><a href="eshop.php">Continue shopping</a></button>
            <button class="btn btn-danger" type="submit"><a href="logout.php">Log out</a></button>
        </div>
    </div>
</main>
<?php
require "incl/footer.php";
?>



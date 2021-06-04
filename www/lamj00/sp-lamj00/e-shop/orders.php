<?php
require "incl/header.php";
require "incl/navbar.php";
require_once "db/Order.php";
require_once "db/OrdersDB.php";
require_once "functions/adminRequired.php";
$ordDB = new OrdersDB();
$orders = $ordDB ->fetchAll();
$isSubmitted = !empty($_GET["to_delete"]);

if($isSubmitted){
    $order = new Order();
    $order -> gatherData($_GET["to_delete"]);
    $order -> clearData();
}
?>
<main class="cont" >
    <h1 class="text-center">Orders</h1>
    <div>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Order ID</th>
                <th scope="col">Date</th>
                <th scope="col">Address</th>
                <th scope="col">Total price</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($orders as $item):?>
                <tr>
                    <td><?php echo $item["ID"]?></td>
                    <td><?php echo $item["date"]?></td>
                    <td><?php echo $item["address"]?></td>
                    <td><?php echo number_format($item["total_price"], 2), ' ', "$"; ?></td>
                    <td> <a href="orders.php?to_delete=<?php echo $item["ID"]?>">
                        <button class="btn btn-danger"
                                type="button">
                           Delete order
                        </button></a>
                    </td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>
</main>

<?php
require "incl/footer.php";
?>



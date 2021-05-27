<?php
require "incl/header.php";
require "incl/navbar.php";
require_once "db/productsDB.php";
require_once "db/ordersDB.php";
require_once "db/orders_contentDB.php";

$ordDB = new ordersDB;
$orCoDB = new orders_contentDB;
$prodDB = new productsDB;
$products = $prodDB ->fetchAll();

$order =[];
$total = 0;
foreach ($_SESSION["cart"] as $item){
    $new = ["id"=>$item["id"],
        "amount"=> $item["amount"],
        "product_name" => $products[(int)$item["id"] -1]["product_name"],
        "price" => $products[(int)$item["id"] -1]["price"]
    ];
    array_push($order,$new);
    $total += (int)$new["price"]*(int)$new["amount"];
}

$orderID = $ordDB ->addItem([$total,$_SESSION["user_id"]]);
foreach ($order as $item){
    $orCoDB ->addItem([$orderID,$item["id"],$item["amount"]]);
}


?>


<main class="container" style="text-align: center">
    <H1>Order has been created</H1>
    <div>
        <button class="btn btn-primary" type="submit" ><a href="eshop.php?RC=true">Continue shopping</a> </button>
        <button class="btn btn-danger" type="submit" ><a href="logout.php">Log out</a> </button>
    </div>
</main>
<?php
require  "incl/footer.php";
?>



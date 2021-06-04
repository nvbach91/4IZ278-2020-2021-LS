<?php
require_once "db/ProductsDB.php";
$prodDB = new productsDB;
$products = $prodDB ->fetchAll();
@$cart = $_SESSION["cart"];
$cart2 =[];
$total = 0;
if ($cart)
    foreach (@$cart as $item){
        $new = ["id"=>$item["id"],
            "amount"=> $item["amount"],
            "product_name" => $products[(int)$item["id"] -1]["product_name"],
            "price" => $products[(int)$item["id"] -1]["price"]
        ];
        array_push($cart2,$new);
        $total += (int)$new["price"]*(int)$new["amount"];
    }
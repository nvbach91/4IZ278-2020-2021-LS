<?php
require_once "db/ProductsDB.php";
$prodDB = new productsDB;
$products = $prodDB ->fetchAll();
@$cart = $_SESSION["cart"];
$cart2 =[];
$total = 0;
if ($cart)
    foreach (@$cart as $item){
        $prod = $prodDB -> getItem("ID",$item["id"] );
        $new = ["id"=>$item["id"],
            "amount"=> $item["amount"],
            "product_name" => $prod["product_name"],
            "price" => $prod["price"]
        ];
        array_push($cart2,$new);
        $total += (int)$new["price"]*(int)$new["amount"];
    }
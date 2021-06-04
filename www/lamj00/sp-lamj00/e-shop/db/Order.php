<?php
require_once "OrdersContentDB.php";
require_once "ProductsDB.php";
require_once "OrdersDB.php";



class Order
{
    private $id;
    private $total;
    private $date;
    private $address;
    private array $products = [];
    private $userID;

    public function gatherData(int $id){
        $ordDB = new OrdersDB;
        $orCoDB = new OrdersContentDB;
        $prodDB = new ProductsDB;
        $ord = $ordDB ->getItem("ID", $id);
        @$this ->total = $ord["total_price"];
        @$this ->date = $ord["date"];
        @$this ->id = $ord["ID"];
        @$this ->address = $ord["address"];
        @$this ->userID = $ord["fk_users_ID"];
        $orCoDB ->fetchAll();
        foreach ($orCoDB ->fetchAll() as $item){
            if($item["fk_orders"] == $this -> id){
                $product = $prodDB ->getItem("ID",$item["fk_products"]);
                $product["quantity"] = $item["quantity"];
                array_push($this -> products, $product);
            }
        }
    }
    public function writeData(){
        $prodDB = new productsDB;
        $ordDB = new ordersDB;
        $orCoDB = new ordersContentDB;
        $userDB = new UsersDB();
        $ordPro =[];
        $total = 0;
        $date = date('Y-m-d H:i:s');
        $address = $userDB -> getItem("ID",$_SESSION["user_id"])["address"];


        foreach($_SESSION["cart"] as $item){
            $new = [$item["id"],$item["amount"]];
            array_push($ordPro,$new);
            $product = $prodDB ->getItem("ID",$item["id"]);
            $total += (int)$product["price"]*(int)$item["amount"];
        }
        $id =  $ordDB ->addItem([$total,$_SESSION["user_id"],$date,$address]);
        foreach ($ordPro as $item){
            array_unshift($item,$id);
            $orCoDB -> addItem($item);
        }
    $this->gatherData($id);
    }
    public function clearData(){
        $ordDB = new ordersDB;
        $orCoDB = new ordersContentDB;
        $ordDB ->deleteItems("ID",$this ->id);
        $orCoDB ->deleteItems("fk_orders",$this ->id);

    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return array
     */
    public function getProducts(): array
    {
        return $this->products;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @return mixed
     */
    public function getUserID()
    {
        return $this->userID;
    }
}
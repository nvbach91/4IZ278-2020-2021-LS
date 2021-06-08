<?php


class SummaryController extends BaseController
{
    public $order;
    public $products;
    public $address;

    public function action()
    {
        if (!isset($_GET['order']) || !is_numeric($_GET['order']) || !User::isUserLoggedIn()) {
            header("Location: " . BASE_URL);
            die();
        }

        $this->order = Order::getInstance($_GET['order']);
        if ($this->order->load()) {
            if ($this->order->users_id != User::getCurrentUserId()) {
                header("Location: " . BASE_URL);
                die();
            }
            $this->address = Address::getInstance($this->order->delivery_addresses_id);
            $this->address->load();
            $this->products = OrderProduct::getProductsByOrderId($this->order->getId());
        } else {
            header("Location: " . BASE_URL);
            die();
        }

    }
}
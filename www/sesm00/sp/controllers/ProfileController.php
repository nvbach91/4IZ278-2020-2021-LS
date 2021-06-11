<?php


class ProfileController extends BaseController
{

    public $orders;
    public $ordersCount;
    public $currentPage;

    public function action()
    {
        if (!User::isUserLoggedIn()) {
            header("Location: " . getBaseUrl());
            die();
        }

        $this->currentPage = 1;

        if (isset($_GET['page']) && is_numeric($_GET['page'])) {
            $this->currentPage = $_GET['page'];
        }

        $this->orders = Order::getOrdersForUser(User::getCurrentUserId(), $this->currentPage);

        $this->ordersCount = Order::getOrdersCountForUser(User::getCurrentUserId());


    }

}
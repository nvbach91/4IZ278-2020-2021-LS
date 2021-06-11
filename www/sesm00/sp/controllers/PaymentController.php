<?php


class PaymentController extends BaseController
{

    public function action()
    {
        if (!isset($_GET['order']) || !is_numeric($_GET['order']) || !User::isUserLoggedIn()) {
            header("Location: " . BASE_URL);
            die();
        }

        $order = Order::getInstance($_GET['order']);
        if ($order->load()) {
            if ($order->users_id != User::getCurrentUserId()) {
                header("Location: " . BASE_URL);
                die();
            }
            $order->payed = 1;
            $order->update();
        } else {
            header("Location: " . BASE_URL);
            die();
        }

        MediaManager::addJavascriptConstant("payment_url", "\"http://" . $_SERVER['HTTP_HOST'] . BASE_URL . "summary?order=" . $_GET['order'] . "\"");
        MediaManager::addJavascript(MediaManager::SCRIPT_URL . "payment.js", "1.1");
    }
}
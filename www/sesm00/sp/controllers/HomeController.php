<?php


class HomeController extends BaseController {

    public $msgs;
    public $categories;
    public $userLoggedIn;

    public function action()
    {
        $this->userLoggedIn = User::isUserLoggedIn();

        if ($this->userLoggedIn) {
            session_start();
        }

        $this->msgs = array();

        if (isset($_GET['err'])) {
            if ($_GET['err'] == "gvf") {
                $this->msgs[] = array("msg" => "Google účet musí nemá ověřenou emailovou adresu. Pro použití je třeba ji ověřit", "type" => "danger");
            } elseif ($_GET['err'] == "gme") {
                $this->msgs[] = array("msg" => "Email již využívá jinou přihlašovací metodu", "type" => "danger");
            }
        }

        $this->categories = Category::getAll();
    }
}


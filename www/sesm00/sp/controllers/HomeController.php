<?php


class HomeController extends BaseController {

    public function action()
    {
        if (isset($_COOKIE['user'])) {
            session_start();
        }
    }
}


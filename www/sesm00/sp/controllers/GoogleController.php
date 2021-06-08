<?php

class GoogleController extends BaseController {

    public $errors;

	public function action() {

	    if (User::isUserLoggedIn()) {
	        header("Location: " . getBaseUrl());
        }

        $this->errors = array();
        $showLogin = true;

        if (isset($_GET['state']) && $_GET['state'] == "testovaci-hodnota" && $_SERVER['REQUEST_METHOD'] != 'POST') {
            $showLogin = false;
        } else if (isset($_GET['state']) && $_GET['state'] == "testovaci-hodnota" && isset($_POST['phone'])) {
            $showLogin = false;
        }

        $google = GoogleAuth::getInstance();
        if ($showLogin) {
            $google->redirectToGoogle();
        } else if ($_GET['state'] == "testovaci-hodnota") {

            session_start();
            if (isset($_POST['phone'])) {

                if (!$google->setAccessToken($_SESSION['token'])) {
                    $google->redirectToGoogle();
                }
                $userData = $google->getUserInfo();

                $user = new User(-1, $userData['firstname'], $userData['lastname'], $userData['email'], uniqid('',true), $_POST['phone'], "", $userData['id']);
                $result = $user->validate();
                if ($result['success']) {
                    $token = uniqid('',true);
                    $user->token = md5($token);
                    $user->create();
                    setcookie("user", $token, time() + 3600, getCookiePath());
                    header("Location: " . getBaseUrl());
                    die();
                }

                $this->errors[] = $result['msg'];

            } else {
                $google->authenticate($_GET['code']);
                $userData = $google->getUserInfo();
                if (!$userData['verified']) {
                    header("Location: " . getBaseUrl() . "?err=gvf");
                    die();
                }

                $result = User::googleLogin($userData["email"], $userData["id"]);
                if ($result['success']) {
                    setcookie("user", $result['token'], time() + 3600, getCookiePath());
                    header("Location: " . getBaseUrl());
                    die();
                } else {
                    if ($result['exist']) {
                        header("Location: " . getBaseUrl() . "?err=gme");
                        die();
                    }
                }

                $_SESSION['token'] = $google->getAccessToken();
            }

        }
	}

}
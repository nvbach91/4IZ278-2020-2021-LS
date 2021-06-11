<?php

class LoginController extends BaseController {

    public $errors;

    public function action()
    {
        $this->errors = array();

        if (User::isUserLoggedIn()) {
            header("Location: " . BASE_URL );
            die();
        }

        if (isset($_POST['email']) && isset($_POST['password'])) {

            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                array_push($this->errors, "Tento email není platný");
            }

            if (strlen($_POST['password']) < 6) {
                array_push($this->errors, "Heslo je moc krátké");
            }

            if (count($this->errors) == 0) {
                $result = User::login($_POST['email'], $_POST['password']);

                if ($result['success']) {
                    setcookie("user", $result['token'], time() + 3600, getCookiePath());
                    header("Location: " . BASE_URL );
                    die();
                } else {
                    array_push($this->errors, $result['msg']);
                }
            }

        }
    }
}


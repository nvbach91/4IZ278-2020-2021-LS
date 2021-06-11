<?php

class RegistrationController extends BaseController {

    public $errors;
    public $success;

    public function action()
    {
        $this->errors = array();
        $this->success = false;

        if (User::isUserLoggedIn()) {
            header("Location: " . BASE_URL );
            die();
        }

        if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['passwordConfirm']) && isset($_POST['firstname']) &&
            isset($_POST['lastname']) && isset($_POST['phone'])) {

            if ($_POST['password'] != $_POST['passwordConfirm']) {
                array_push($this->errors, "Hesla nejsou shodná");
            }

            if (count($this->errors) == 0) {
                $user = new User(-1, $_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['password'], $_POST['phone']);
                $result = $user->validate();
                if ($result['success']) {
                    if ($user->create()) {
                        $this->success = true;
                    } else {
                        array_push($this->errors, "Vytvoření uživatele selhalo");
                    }
                } else {
                    array_push($this->errors, $result['msg']);
                }
            }
        } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            array_push($this->errors, "Je třeba vyplnit všechna pole");
        }

    }
}


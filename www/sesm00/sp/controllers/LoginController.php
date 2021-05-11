<?php

class LoginController extends BaseController {

    public $errors;

    public function action()
    {
        $this->errors = array();

        if (isset($_POST['email']) && isset($_POST['password'])) {

            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                array_push($this->errors, "Email je neplatný");
            }

            if (strlen($_POST['password']) < 6) {
                array_push($this->errors, "Heslo je neplatné");
            }

            if (count($this->errors) == 0) {
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $usersDB = new UsersDB();

                $users = $usersDB->fetchBy(array('where' => array('email' => $_POST['email'])));
                if (count($users) > 0) {
                    if (password_verify($_POST['password'], $users[0]['password'])) {
                        setcookie("user", $users[0]['ident'], time() + 3600);
                        header("Location: " . BASE_URL );
                        die();
                    }
                }
                array_push($this->errors, "Tato kombinace hesla a mailu není známá");
            }

        }
    }
}


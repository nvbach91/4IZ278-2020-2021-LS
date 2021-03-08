<?php


namespace cv04\src\authentication;


use cv04\src\domain\User;
use cv04\src\services\UserService;

class Authentication
{
    private $service;

    public function __construct() {
        // Start the session only if it was not started before
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->service = new UserService();
    }

    public function check(): bool {
        return isset($_SESSION["user"]) && $this->service->findUserByUsername($_SESSION["user"]) !== null;
    }

    public function login(string $email, string $password): bool {
        $user = $this->service->findUserByEmail($email);

        if ($user === null) {
            return false;
        }

        if (password_verify($password, $user->password)) {
            $_SESSION["user"] = $user->username;
            return true;
        }

        return false;
    }

    public function logout(): void {
        $_SESSION["user"] = null;
    }

    public function user(): ?User {
        if (!isset($_SESSION["user"])) {
            return null;
        }

        return $this->service->findUserByUsername($_SESSION["user"]);
    }
}
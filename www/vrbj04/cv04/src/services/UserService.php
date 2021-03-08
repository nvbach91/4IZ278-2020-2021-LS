<?php


namespace cv04\src\services;


use cv04\src\domain\User;

class UserService
{
    /**
     * @var User[]
     */
    private $database;

    private const FILE_STORAGE = __DIR__ . "/../../users.db";

    public function __construct() {
        // This could be configurable... but you know...
        $source = file_get_contents(self::FILE_STORAGE);
        $lines = explode("\n", $source);
        $users = array_filter($lines, function ($line) { return !empty(trim($line)); });

        $this->database = array_map(function ($line) { return $this->deserializeUser($line); }, $users);
    }

    public function users(): array {
        return $this->database;
    }

    public function findUserByUsername(string $username): ?User {
        $match = array_filter($this->database, function ($user) use ($username) {
            return $user->username == $username;
        });

        return array_values($match)[0] ?? null;
    }

    public function findUserByEmail(string $email): ?User {
        $match = array_filter($this->database, function ($user) use ($email) {
            return $user->email == $email;
        });

        return array_values($match)[0] ?? null;
    }

    public function register(string $username, string $email, string $password): void {
        $user = new User($username, $email, password_hash($password, PASSWORD_BCRYPT));

        $this->database[] = $user;
        $this->persistDatabase();
    }

    private function serializeUser(User $user): string {
        return "$user->username,$user->email,$user->password";
    }

    private function deserializeUser(string $line): User {
        [$username, $email, $password] = explode(",", $line);
        return new User($username, $email, $password);
    }

    private function persistDatabase(): void {
        $lines = array_map(
            function ($user) { return $this->serializeUser($user); },
            $this->database
        );

        file_put_contents(self::FILE_STORAGE, implode("\n", $lines));
    }
}
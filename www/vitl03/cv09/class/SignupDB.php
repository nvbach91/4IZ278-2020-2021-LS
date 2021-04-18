<?php require_once __DIR__ . '/../Database.php'; ?>
<?php

class SignupDB extends Database
{
    protected $tableName = 'users';
    public function fetchAll()
    {
        
        if ('POST' == $_SERVER['REQUEST_METHOD']) {
            $email = htmlspecialchars(trim(($_POST['email'])));
            $password = htmlspecialchars(trim(($_POST['password'])));
        
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            //$stmt = $pdo->prepare('INSERT INTO users(email, password, privillage) VALUES (:email, :password, 3)');
            $statement = $this->pdo->prepare('INSERT INTO users(email, password) VALUES (:email, :password)');
            $statement->execute([
                'email' => $email,
                'password' => $hashedPassword
            ]);
        
            $statement = $this->pdo->prepare('SELECT id FROM users WHERE email = :email LIMIT 1'); //limit 1 jen jako vykonnostni optimalizace, 2 stejne maily se v db nepotkaji
            $statement->execute([
                'email' => $email
            ]);
            $user_id = (int) $statement->fetchColumn();
        
            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_email'] = $email;
        
            header('Location: index.php');
        }
        }

  
}

?> 
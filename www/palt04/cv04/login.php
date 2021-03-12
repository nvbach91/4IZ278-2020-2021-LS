<?php 
$invalidInputs = [];
$alertMessages = [];
$errors = [];
$alertType = 'alert-danger';

function makeLogin($data) {
        $databaseFileName = getcwd().'/database/users.db';
        
        $lines = file($databaseFileName);

        $isExistingUser = false;
        $success = false;
        $message = '';
        foreach ($lines as $line) {
            if (!$line) {
                continue;
            }

            $fields = explode(';', $line);

            $user = [
                'name' => $fields[0],
                'email' => $fields[1],
                'password' => preg_replace('/\s+/', '', $fields[2]),
            ];

            if ($user['password'] === $data['password'] && $user['email'] === $data['email']) {
                $isExistingUser = true;
                echo 'ano'.'<br>';
                break;
            }
        }

        if (!$isExistingUser) {
            $message = 'Invalid email or password';
        }
        else {
            $success = true;
        }

        $result = [
            'success' => $success,
            'message' => $message,
        ];

        return $result;
}

$submittedForm = !empty($_POST);    
if ($submittedForm) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        if (!$email) {
            array_push($alertMessages, 'Missing email field');
            array_push($invalidInputs, 'email');
        }

        if (!$password) {
            array_push($alertMessages, 'Missing password field');
            array_push($invalidInputs, 'password');
        }


        if (empty($invalidInputs)) {
            $loginResult = makeLogin($_POST);
            if ($loginResult['success']) {       
                    header("Location: index.php");
            } else {
                    array_push($alertMessages, $loginResult['message']);
            }
        }
    }
?>
<?php include __DIR__ . '/includes/header.php'; ?>
<?php include __DIR__ . '/includes/navigation.php'; ?>
<main>
    <h1>Login</h1>
    <?php if ($submittedForm): ?>
        <div class="alert <?php echo $alertType; ?>"><?php echo implode('<br>', $alertMessages); ?></div>
    <?php endif; ?>  
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email:</label>
            <input type="email" name="email" class="form-control<?php echo in_array('email', $invalidInputs) ? ' is-invalid' : '' ?>" value="<?php echo isset($email) ? $email : '' ?>">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password:</label>
            <input type="password" name="password" class="form-control<?php echo in_array('password', $invalidInputs) ? ' is-invalid' : '' ?>" value="<?php echo isset($password) ? $password : '' ?>">
        </div>
        <button class="btn btn-primary">Log in</button>
    </form>
</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
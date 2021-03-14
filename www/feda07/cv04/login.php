<?php


function fetchUsers($data)
{
    $databaseFileName = __DIR__ . '/database/users.db';
    $userRecords = file($databaseFileName);
    $isExistingUser = false;
    $isEmailTrue = false;
    $name='';
    foreach ($userRecords as $userRecord) {
        if (!$userRecord) {
            continue;
        }
        $userRecord = trim($userRecord);
        $fields = explode(';', $userRecord);
        // ['alex fedina', 'sas@mail.ru', '1234']

        $user = [
            'name' => $fields[0],
            'email' => $fields[1],
            'password' => $fields[2],
        ];

        if ($user['email'] === $data['email'] && $user['password'] === $data['password']) {
            $isExistingUser = true;
            $name=$user['name'];
            break;
        } elseif($user['email'] === $data['email']){
            $isEmailTrue =true;
        }
    }
    if ($isExistingUser) {
        return ['success' => true, 'message' => 'Congratulations, you are successfully logged in..', 'name' => $name];
    } elseif($isEmailTrue) {
        return ['success' => false, 'message' => 'Password is incorrect, please try another password.', 'name' => ''];
    }
    return ['success' => false, 'message' => 'User does not exist, please register!', 'name' => ''];


}

$isSubmitted = empty($_POST) ? false : true;

$invalidInputs = [];
$message = [];
if (!empty($_POST)) {

    $email = $_POST['email'];
    $password = $_POST['password'];
    if (!$email) {
        array_push($invalidInputs, 'Email is empty!');
    }
    if (!$password) {
        array_push($invalidInputs, 'Password is empty!');
    }

    if (empty($invalidInputs)) {
        $loginResult = fetchUsers($_POST);
        array_push($message, $loginResult['message']);
        if ($loginResult['success']) {
            $name=$loginResult['name'];
            header("Location: hello_page.php?name=$name");
        }
    }

}


?>

<?php include __DIR__ . '/includes/head.php'; ?>
<?php include __DIR__ . '/navigation.php'; ?>
<main class="login">
    <h1>LOG IN</h1>
    <?php foreach ($message

    as $mes): ?>
    <p><?php echo $mes ?>
        <?php endforeach; ?>
        <?php foreach ($invalidInputs

        as $invalidInput): ?>
    <p><?php echo $invalidInput ?>
        <?php endforeach; ?>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="card-login">
        <div class="form-group">
            <label for="email">Username</label><br>
            <input placeholder="email" name="email" type="email" id="email" class="input" value="<?php if(isset( $_GET['email'])) echo $_GET['email'] ?>">
        </div>
        <br>
        <div class="form-group">
            <label for="password">Password</label><br>
            <input placeholder="password" name="password" type="password" id="password" class="input">
        </div>
        <button type="submit" class="btn btn-success">Log in</button>
    </form>
</main>
<?php include __DIR__ . '/includes/foot.php'; ?>

<?php

include __DIR__ . '/utils.php';

function makeRegistration($data)
{
    $dbFileName = __DIR__ . '/database/users.db';

    $userRecords = file($dbFileName);
    $userExist = false;

    foreach ($userRecords as $userRecord) {
        if (!$userRecord) {
            continue;
        }
        $fields = explode(';', $userRecord);
        $user = ['name' => $fields[0],
            'email' => $fields[1],
            'password' => $fields[2]
        ];
        if ($user['email'] == $data['email']) {
            $userExist = true;
            break;
        }
    }

    if ($userExist) {
        return ['success' => false, 'msg' => 'Email already exists'];
    }

    $user = [
        $data['name'],
        $data['email'],
        $data['password'],
    ];
    $record = implode(';', $user) . "\r\n";

    file_put_contents($dbFileName, $record, FILE_APPEND);
    return ['success' => true, 'msg' => 'Success, user added'];
}

$invalidInputs = [];

if (!empty($_POST)) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $passwd = $_POST['password'];
    $passwdConf = $_POST['confirm'];

    //validace

    if (!$name) {
        array_push($invalidInputs, 'Empty name');
    }

    if (!$email) {
        array_push($invalidInputs, 'Empty email');
    }
    if (!$passwd || $passwd !== $passwdConf) {
        array_push($invalidInputs, 'Passwords do not match');
    }

    if (empty($invalidInputs)) {
        $registrationResult = makeRegistration($_POST);

        if ($registrationResult['success']) {
            //send mail
            sendEmail($email, 'Account created');
            header("Location: login.php?email=$email");
        } else {
            array_push($invalidInputs, $registrationResult['msg']);
        }
    }
}
?>
<?php include __DIR__ . '/includes/head.php'; ?>
<?php include __DIR__ . '/includes/navigation.php'; ?>

<main class="container">
    <h1 class="text-center">Registration</h1>
    <?php foreach ($invalidInputs as $input): ?>
        <div class="alert alert-danger" role="alert"><?php echo $input; ?> </div>
    <?php endforeach; ?>

    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" class="form-registration">
        <label class="form-label" for="name">Name</label>
        <input class="form-control mb-3" id="name" type="text" placeholder="name" name="name">
        <label class="form-label" for="email">Email</label>
        <input class="form-control mb-3" id="email" type="email" placeholder="email" name="email">
        <label class="form-label" for="passwd">Password</label>
        <input class="form-control mb-3" id="passwd" type="password" placeholder="password" name="password">
        <label class="form-label" for="passwdconf">Password Again</label>
        <input class="form-control mb-3" id="passwdconf" type="password" placeholder="confirm password" name="confirm">
        <button class="btn btn-primary" type="submit">Submit</button>
    </form>
</main>

<?php include __DIR__ . '/includes/foot.php'; ?>

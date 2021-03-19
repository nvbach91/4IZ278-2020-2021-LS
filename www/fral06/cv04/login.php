<?php include __DIR__ . '/includes/head.php'; ?>
<?php include __DIR__ . '/includes/navigation.php'; ?>

<?php
function fetchUser($email)
{
    $dbFileName = __DIR__ . '/database/users.db';

    $userRecords = file($dbFileName);
    foreach ($userRecords as $userRecord) {
        $userRecord = trim($userRecord);
        if (!$userRecord) continue; // skip blank lines
        $user = explode(';', $userRecord);
        if ($user[1] === $email) {
            return [
                'name' => $user[0],
                'email' => $user[1],
                'password' => $user[2],
            ];
        }
    }
    return null;
}

function authenticate($email, $password)
{
    $user = fetchUser($email);
    if (!$user) {
        return ['success' => false, 'msg' => 'Account does not exist'];
    }

    if ($user['password'] !== $password) {
        return ['success' => false, 'msg' => 'Wrong password'];
    }
    return ['success' => true, 'msg' => 'Login success'];
}

;

$messages = [];
$errors = [];

if (!empty($_GET['email'])) {
    $email = $_GET['email'];
}

if (!empty($_POST)) {
    // get all fields while trimming them and converting any special chars to html entities
    $email = $_POST['email'];
    $password = $_POST['passwd'];
    $authentication = authenticate($email, $password);

    if (!$authentication['success']) {
        array_push($messages, ['msg' => $authentication['msg'], 'type' => 'error']);

    } else {
        array_push($messages, ['msg' => $authentication['msg'], 'type' => 'success']);
    }
}
?>

<main class="container">
    <h1 class="text-center">Login</h1>
    <?php foreach ($messages as $input): ?>
        <div class="alert alert-<?php echo $input['type'] == 'error' ? 'danger' : 'success'; ?>" role="alert">
            <?php echo $input['msg']; ?>
        </div>
    <?php endforeach; ?>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" class="form-registration">
        <label class="form-label" for="email">Email</label>
        <input class="form-control mb-3" id="email" type="email" value="<?php echo isset($email) ? $email : ''; ?>"
               placeholder="email" name="email">
        <label class="form-label" for="passwd">Password </label>
        <input class="form-control mb-3" id="passwd" type="password" placeholder="Password" name="passwd">
        <button class="btn btn-primary" type="submit">Submit</button>
    </form>

</main>

<?php include __DIR__ . '/includes/foot.php'; ?>


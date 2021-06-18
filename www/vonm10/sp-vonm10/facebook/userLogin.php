<?php require_once __DIR__ . '/../db/UsersDB.php'; ?>
<?php


require_once  __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/../config/global.php';

session_start();
if (!$_SESSION['access_token']) {
    header('Location: index.php');
    die();
}


require_once __DIR__ . '/vendor/autoload.php';

$fb = new \Facebook\Facebook([
    'app_id' => APP_ID,
    'app_secret' => APP_SECRET,
    'default_graph_version' => 'v2.10',
    'default_access_token' => $_SESSION['access_token'],
]);

$usersDB = new UsersDB();
$userRecords = $usersDB->fetchAll();

$me = $fb->get('/me')->getGraphUser();
$email = $fb->get('/me/?fields=email')->getGraphUser()['email'];
$token = $_SESSION['access_token']->getValue();

if (!isset($email)) {
    die('Missing email');
}
$isExistingUser = false;
foreach ($userRecords as $userRecord) {
    if (!$userRecord) {
        continue;
    }

    if ($userRecord['email'] == $email) {
        $isExistingUser = true;
        $userToken = trim($userRecord['password']);
        $admin = $userRecord['admin'];
        $userId = $userRecord['id'];
        break;
    }
}

if (!$isExistingUser) {
    $usersDB->addUser($email, $token);
    session_start();
    $_SESSION['login'] = true;
    $_SESSION['admin'] = $admin;
    $_SESSION['user_id'] = $userId;
    header('Location: /../~vonm10/beardwithme/index.php');
} else {
    session_start();
    $_SESSION['login'] = true;
    $_SESSION['admin'] = $admin;
    $_SESSION['user_id'] = $userId;
    header('Location: /../~vonm10/beardwithme/index.php');
}

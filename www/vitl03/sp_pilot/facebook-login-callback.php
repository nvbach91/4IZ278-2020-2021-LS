
<?php require_once __DIR__ . '/vendor/autoload.php'; ?>
<?php require_once __DIR__ . '/class/UsersDB.php'; ?>
<?php
session_start();
$usersDB = new UsersDB();


$fb = new \Facebook\Facebook([
    'app_id' => APP_ID,
    'app_secret' => APP_SECRET,
    'default_graph_version' => 'v2.10',
]);

$helper = $fb->getRedirectLoginHelper();

if (isset($_GET['state'])) {
    $helper->getPersistentDataHandler()->set('state', $_GET['state']);
}


$accessToken = $helper->getAccessToken();

if (!isset($accessToken)) {
    header("Location: login.php");
    exit();
}


$oAuth2Client = $fb->getOAuth2Client();

$accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);

$response = $fb->get("/me?fields=id, first_name, last_name, email, picture.type(large)", $accessToken);
$userData = $response->getGraphNode()->asArray();
$_SESSION['userData'] = $userData;
$_SESSION['access_token'] = $accessToken->getValue();

if(isset($_SESSION['userData'])){

    $user = $usersDB->fetchUserByEmail($_SESSION['userData']['email']);

    if (!$user) {
        $usersDB->insertUser($_SESSION['userData']['first_name'],$_SESSION['userData']['last_name'], $_SESSION['userData']['email']);
    }
}


header('Location: index.php?page=profile');
exit();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <?php echo $response; ?>
</body>

</html>
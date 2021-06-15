<?php require_once __DIR__ . '/../config/global.php'; ?>
<?php
require_once __DIR__ . '/vendor/autoload.php';

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
    die('Bad request');
}

session_start();
$_SESSION['access_token'] = $accessToken;
header('Location: /../~vonm10/beardwithme/facebook/userLogin.php');


?>
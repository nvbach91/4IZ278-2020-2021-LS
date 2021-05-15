<?php
session_start();
// require __DIR__ . '/config.php';

// $code = $_GET['code'];

// $url = 'https://graph.facebook.com/oauth/access_token?' . 
//     'code=' . $code .
//     '&client_id=' . APP_ID .
//     '&client_secret=' . APP_SECRET .
//     '&redirect_uri=' . LOGIN_CALLBACK_URL;

// $response = json_decode(file_get_contents($url), true);

// $accessToken = $response['access_token'];

// $_SESSION['access_token'] = $accessToken;

// header('Location: profile.php');





require_once './vendor/autoload.php';
require './_inc/config.php';

$fb = new \Facebook\Facebook([
    'app_id' => APP_ID,
    'app_secret' => APP_SECRET,
    'default_graph_version' => 'v2.10',
]);

$helper = $fb->getRedirectLoginHelper();

if (isset($_GET['state'])) {
    $helper->getPersistentDataHandler()->set('state', $_GET['state']);
}

try {
    $accessToken = $helper->getAccessToken();
    if(isset($accessToken)) {
        $_SESSION['access_token'] = $accessToken;

        header('Location: index.php');
    }
} catch (Exception $exc) {
    echo $exc->getTraceAsString();
}

if (!isset($accessToken)) {
    die('Bad request');
}

$_SESSION['access_token'] = $accessToken->getValue();

header('Location: profile.php');

?>
<?php
session_start();

require_once __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/config.php';

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

$fbUserData = array();
    $fbUserData['oauth_uid']  = !empty($fbUser['id'])?$fbUser['id']:'';
    $fbUserData['first_name'] = !empty($fbUser['first_name'])?$fbUser['first_name']:'';
    $fbUserData['last_name']  = !empty($fbUser['last_name'])?$fbUser['last_name']:'';
    $fbUserData['email']      = !empty($fbUser['email'])?$fbUser['email']:'';
    
if (!isset($accessToken)) {
    die('Bad request');
}

$_SESSION['access_token'] = $accessToken->getValue();

header('Location: profile.php');



?>

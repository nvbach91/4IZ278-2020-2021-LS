<?php

use Facebook\Facebook;

session_start();

require_once __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/config.php';

$fb = new Facebook([
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

$_SESSION['access_token'] = $accessToken->getValue();

header('Location: profile.php');



?>
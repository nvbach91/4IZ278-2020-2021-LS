<?php
session_start();

require_once './composer/vendor/autoload.php';
require './config.php';

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
} catch (Exception $exc) {
    echo $exc->getTraceAsString();
}

if (!isset($accessToken)) {
    die('Bad request');
}

header('Location: ../index.php?access_token='.$accessToken->getValue());

?>
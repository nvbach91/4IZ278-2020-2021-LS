<?php
$fb = new \Facebook\Facebook(array_merge(CONFIG_FACEBOOK, ['default_access_token' => $_SESSION['fb_access_token']]));
try {
    $response = $fb->get('/me?fields=name,email,location,gender,birthday,hometown');
} catch (\Facebook\Exceptions\FacebookResponseException $e) {
    echo $e->getMessage();
} catch (\Facebook\Exceptions\FacebookSDKException $e) {
    echo $e->getMessage();
}

require_once __DIR__ . '/../utils/utils.php';

if (session_status() != 2) {
    session_start();
}

try {
    $me = $response->getGraphUser();
} catch (\Facebook\Exceptions\FacebookSDKException $e) {
    echo $e->getMessage();
}

$id = $me->getId();

$_SESSION['user_facebook_id'] = (string)$id;


$userName = $me->getName();

$email = $me->getEmail();


$req = [
    "name" => $userName,
    "email" => $email ? $email : "",
    "password" => "",
    "facebook_id" => $id
];

registerNewUser($req, true);

header('Location: ../index');
?>

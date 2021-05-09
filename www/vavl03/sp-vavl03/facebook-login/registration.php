<?php 
//check if users id is in my db, if not create new user
$fb = new \Facebook\Facebook(array_merge(CONFIG_FACEBOOK, ['default_access_token' => $_SESSION['fb_access_token']]));
try {
    $me = $fb->get('/me')->getGraphUser();
} catch (\Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch (\Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}

$userFbId = $me->getId();
var_dump($userFbId);
$userName = $me->getName();
$email = $fb->get('/me?locale=en_US&fields=email')->getGraphUser();
var_dump($email['email']);
$usersDB = new UsersDB();
$user = $usersDB->fetchUserbyFbId($userFbId);
if(!$user){
    $usersDB->createUser($userFbId,$userName,$email['email']);
    header('Location: ../cart.php');
}else{
    header('Location: ../cart.php');
}

?>
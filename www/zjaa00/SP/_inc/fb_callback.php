<?php

require_once './composer/vendor/autoload.php';
require_once './config.php';

$fb = new \Facebook\Facebook([
    'app_id' => APP_ID,
    'app_secret' => APP_SECRET,
    'default_graph_version' => 'v2.10',
]);

$helper = $fb->getRedirectLoginHelper();

if (isset($_GET['state'])) {
    $helper->getPersistentDataHandler()->set('state', $_GET['state']);
}

$access_token = $helper->getAccessToken();

if (!isset($access_token)) {
    die('Bad request');
}

$access_token = $access_token->getValue();

$fb = new \Facebook\Facebook([
    'app_id' => APP_ID,
    'app_secret' => APP_SECRET,
    'default_graph_version' => 'v2.10',
    'default_access_token' => $access_token,
  ]);

  $me = $fb->get('/me?fields=email')->getGraphUser();
  $email = $me['email'];

  /* $minutesOfLogin = 60*12; //v minútach
   */

  $select = $connect->prepare('
    SELECT * FROM users
    WHERE email = :email
    LIMIT 1;
  ');
  $select->execute(['email' => $email]);
  @$user = $select->rowCount();
  if (!$user) {
    $insert = $connect->prepare("INSERT INTO users (email, password, privilege) VALUES (:email, NULL, 1);");
    $insert->execute([
      'email' => $email,
    ]);
  }

  $_SESSION['email'] = $email;
  
  header('Location: ../index.php');

?>
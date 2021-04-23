<?php 

require_once __DIR__ . '/vendor/autoload.php'; // change path as needed

$fb = new \Facebook\Facebook([
    'app_id' => '{app-id}',
    'app_secret' => '{app-secret}',
    'default_graph_version' => 'v2.10',
    //'default_access_token' => '{access-token}', // optional
]);


?>

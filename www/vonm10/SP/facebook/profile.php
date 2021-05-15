<?php

// podminka session

require_once  __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/../config/global.php';

session_start();
if (!$_SESSION['access_token']) {
    header('Location: index.php');
    die();
}


require_once __DIR__ . '/vendor/autoload.php';

$fb = new \Facebook\Facebook([
    'app_id' => APP_ID,
    'app_secret' => APP_SECRET,
    'default_graph_version' => 'v2.10',
    'default_access_token' => $_SESSION['access_token'],
]);

$me = $fb->get('/me')->getGraphUser();

$picture = $fb->get('/me/picture?redirect=false&height=200')->getGraphUser();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Profile</h1>
    <div><?php echo $_SESSION['access_token']; ?></div>
    <div>User: <?php echo $me['name']; ?> </div> 
    <img alt="" src="<?php echo $picture['url']; ?>">
</body>
</html>
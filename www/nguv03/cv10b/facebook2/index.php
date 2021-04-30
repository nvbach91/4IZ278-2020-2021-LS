<?php 

require_once __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/config.php';

$fb = new \Facebook\Facebook([
    'app_id' => APP_ID,
    'app_secret' => APP_SECRET,
    'default_graph_version' => 'v2.10',
]);

$loginUrl = $fb->getRedirectLoginHelper()->getLoginUrl(LOGIN_CALLBACK_URL, ['email']);

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
    <a href="<?php echo $loginUrl; ?>">Login with facebook</a>
    <div><?php echo $loginUrl; ?></div>
</body>
</html>
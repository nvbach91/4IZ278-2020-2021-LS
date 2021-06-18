<?php

require_once  __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/../config/global.php';

$fb = new \Facebook\Facebook([
    'app_id' => APP_ID,
    'app_secret' => APP_SECRET,
    'default_graph_version' => 'v2.10'
]);

$loginUrl = $fb->getRedirectLoginHelper()->getLoginURL(FB_CALLBACK, ['email']);

?>


<?php require __DIR__ . '/../incl/header.php'; ?>
<a href="<?php echo $loginUrl; ?>">Login with facebook</a>
<?php require __DIR__ . '/../incl/footer.php'; ?>
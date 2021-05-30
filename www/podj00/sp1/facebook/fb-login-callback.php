<?php
session_start();

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/config.php';

$fb = new \Facebook\Facebook(CONFIG_FACEBOOK);

$helper = $fb->getRedirectLoginHelper();

if (isset($_GET['state'])) {
    $helper->getPersistentDataHandler()->set('state', $_GET['state']);
}
?>

    <h3>Code</h3>
    <p><?php echo $_GET['code']; ?></p>

<?php
try {
    $accessToken = $helper->getAccessToken();
} catch (\Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch (\Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}

if (!isset($accessToken)) {
    if ($helper->getError()) {
        header('HTTP/1.0 401 Unauthorized');
        echo "Error: " . $helper->getError() . "\n";
        echo "Error Code: " . $helper->getErrorCode() . "\n";
        echo "Error Reason: " . $helper->getErrorReason() . "\n";
        echo "Error Description: " . $helper->getErrorDescription() . "\n";
    } else {
        header('HTTP/1.0 400 Bad Request');
        echo 'Bad request';
    }
    exit;
}
?>
    <h3>Access Token</h3>
    <pre> <?php var_dump($accessToken->getValue()); ?> </pre>

<?php

$oAuth2Client = $fb->getOAuth2Client();

$tokenMetadata = $oAuth2Client->debugToken($accessToken);
?>
    <h3>Metadata</h3>
    <pre> <?php var_dump($tokenMetadata); ?> </pre>

    <pre> <?php /* echo $myAccessToken; */ ?> </pre>

<?php
require_once __DIR__ . '/../database/repositories/UsersRepository.php';

try {
    $tokenMetadata->validateAppId(CONFIG_FACEBOOK['app_id']);
} catch (\Facebook\Exceptions\FacebookSDKException $e) {
}
try {
    $tokenMetadata->validateExpiration();
} catch (\Facebook\Exceptions\FacebookSDKException $e) {
}
if (!$accessToken->isLongLived()) {
    try {
        $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
    } catch (\Facebook\Exceptions\FacebookSDKException $e) {
        echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";
        exit;
    }
    echo '<h3>Long-lived</h3>';
    var_dump($accessToken->getValue());
}

$_SESSION['fb_access_token'] = (string)$accessToken;
$_SESSION['access_token_expiries'] = time() + 3600; // expire login after 1 hour

require_once './facebookRegistration.php';
?>
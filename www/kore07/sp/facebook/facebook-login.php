<?php

    require_once __DIR__ . '/vendor/autoload.php';
    require __DIR__ . '/config.php';

    $fb = new \Facebook\Facebook(CONFIG_FACEBOOK);

    $helper = $fb->getRedirectLoginHelper();
    $permissions = ['email']; // Optional permissions
    $loginUrl = $helper->getLoginUrl(CONFIG_PROTOCOL . CONFIG_DOMAIN . CONFIG_PATH . '/fb-login-callback.php', $permissions);

?>
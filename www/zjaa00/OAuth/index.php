<?php

    require_once "./vendor/autoload.php";
    require './_inc/config.php';
    include "partials/header.php";

    $fb = new Facebook\Facebook([
        'app_id' => APP_ID,
        'app_secret' => APP_SECRET,
        'default_graph_version' => 'v2.10',
    ]);

    $helper = $fb->getRedirectLoginHelper();
    $loginUrl = $helper->getLoginUrl(LOGIN_CALLBACK_URL);

    
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

    <?php include "partials/footer.php"; ?>
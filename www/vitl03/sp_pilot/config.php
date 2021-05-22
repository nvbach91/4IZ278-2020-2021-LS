<?php
require_once 'vendor/autoload.php';

const APP_ID= '371520784155186';
const APP_SECRET = '023e595851150c70d5afa66648d8ed6a';

const LOGIN_CALLBACK_URL = 'https://eso.vse.cz/~vitl03/sp_pilot/facebook-login-callback.php';

$google_client = new Google_Client();
$google_client->setClientId('547208858852-kn6pounh64cpstm8ufk5bb6ti7314jqj.apps.googleusercontent.com');
$google_client->setClientSecret('mrL0mdMcMps1y2l68aeSp4Tm');
$google_client->setRedirectUri('https://eso.vse.cz/~vitl03/sp_pilot/google-login-callback.php');
$google_client->addScope('email');
$google_client->addScope('profile');



?>
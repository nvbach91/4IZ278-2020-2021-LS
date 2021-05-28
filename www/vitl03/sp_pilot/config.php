<?php
require_once 'vendor/autoload.php';



const APP_ID= '371520784155186';
const APP_SECRET = '';

const LOGIN_CALLBACK_URL = '';

$google_client = new Google_Client();
$google_client->setClientId('547208858852-kn6pounh64cpstm8ufk5bb6ti7314jqj.apps.googleusercontent.com');
$google_client->setClientSecret('mrL0mdMcMps1y2l68aeSp4Tm');
$google_client->setRedirectUri('');
$google_client->addScope('email');
$google_client->addScope('profile');

const DB_HOST = 'localhost';
const DB_DATABASE = 'vitl03';
const DB_USERNAME = 'vitl03';
const DB_PASSWORD = '';
const CURRENCY = 'CZK';


?>



?>
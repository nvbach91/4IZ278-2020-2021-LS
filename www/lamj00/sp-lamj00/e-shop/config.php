<?php


//config.php

//Include Google Client Library for PHP autoload file
require_once 'googleAPI/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('461899753034-d0rq0h2015u1gibc06p7g41pn9seem92.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('xqb-fWvlHLMGncHnMAa-m7Ur');

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('http://localhost/e-shop/registration.php');

//
$google_client->addScope('email');

$google_client->addScope('profile');

//start session on web page



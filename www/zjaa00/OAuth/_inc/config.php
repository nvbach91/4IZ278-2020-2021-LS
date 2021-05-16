<?php

//show all errors
ini_set("display_startup_errors", 1);
ini_set("display_errors", 1);
error_reporting(-1); //neskôr zmeniť na 1

//index.php variables
$base_url = "http://nebra.sk/";
$searchPlaceholder = "Hľadaj drink";

// configurations
$config = [

	'db' => [
		'type'     => 'mysql',
		'name'     => 'zjaa00',
		'server'   => 'localhost',
		'username' => 'zjaa00',
		'password' => 'uoyeeCoo7dohx4Aac3',
		'charset'  => 'utf8'
	],

	'db2' => [
		'type'     => 'mysql',
		'name'     => 'drinks',
		'server'   => 'localhost',
		'username' => 'root',
		'password' => 'root',
		'charset'  => 'utf8'
	]

];

//database type
$set = $config['db2'];

// connect to db
$connect = new PDO(
	"{$set['type']}:host={$set['server']};
	dbname={$set['name']};
	charset={$set['charset']}",
	$set['username'],
	$set['password']
);

$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //zmeniť na ERRMODE_SILENT
$connect->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); //iba pripravuje MySQL ale treba to len pri starších verziách - preto false

const APP_ID = '1567592203631828';
const APP_SECRET = '960c6247366ddb6cf0ae3edb6fcd5c52';

const LOGIN_CALLBACK_URL = 'http://localhost/4IZ278-2020-2021-LS/www/zjaa00/OAuth/facebook-login-callback.php';
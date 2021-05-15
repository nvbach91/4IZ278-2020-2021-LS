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

function authorize($privilege = null) {
	if (!isset($_COOKIE['privilege'])) {
		return false;
	}

	if ($privilege == null) {
		return true;
	}

	if ($_COOKIE['privilege'] == $privilege) {
		return true;
	}

	return false;
}

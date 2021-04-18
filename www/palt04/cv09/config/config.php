<?php

//show all errors
ini_set("display_startup_errors", 1);
ini_set("display_errors", 1);
error_reporting(-1);

// configurations
$config = [

	'db' => [
		'type'     => 'mysql',
		'name'     => 'palt04',
		'server'   => 'localhost',
		'username' => 'palt04',
		'password' => 'eiVeeMuL7TheK3toop',
		'charset'  => 'utf8'
	]
];

//database type
$set = $config['db'];

// connect to db
$connect = new PDO(
	"{$set['type']}:host={$set['server']};
	dbname={$set['name']};
	charset={$set['charset']}",
	$set['username'],
	$set['password']
);

$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$connect->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); 
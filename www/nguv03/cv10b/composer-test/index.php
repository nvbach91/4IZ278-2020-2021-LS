<?php 
// automaticke nacteni trid
require __DIR__ . '/vendor/autoload.php';

// nacteni namespace kvuli zkraceni nazvu trid pri pouziti
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// vytvareni instance
$log = new Logger('index.php');

// nastaveni instance
$log->pushHandler(new StreamHandler('warning.log', Logger::WARNING));

// pouziti instance
$log->warning('warning');

?>
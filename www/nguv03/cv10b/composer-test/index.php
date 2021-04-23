<?php

require __DIR__ . '/vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$log = new Logger('name');

$handler = new StreamHandler('warning.log', Logger::WARNING);

$log->pushHandler($handler);

$log->warning('abcdef');

?>
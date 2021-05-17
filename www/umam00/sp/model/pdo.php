<?php

$host = '127.0.0.1';
$db   = 'db_noter';
$user = 'admin';
$pass = 'heslo1234';
$charset = 'utf8mb4';
$port = 3306;

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try {
    $conn = new mysqli($host, $user, $pass, $db, $port);
    $conn ->set_charset($charset);
    $conn ->options(MYSQLI_OPT_INT_AND_FLOAT_NATIVE, 1);
} catch (\mysqli_sql_exception $e) {
     throw new \mysqli_sql_exception($e->getMessage(), $e->getCode());
}
unset($host, $db, $user, $pass, $charset); // we don't need them anymore
?>
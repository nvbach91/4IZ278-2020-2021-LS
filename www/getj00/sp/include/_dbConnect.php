<?php
// Password needs to be censored before submitting to Git
$pdo=new PDO('mysql:host=localhost;dbname=getj00;charset=utf8mb4', 'getj00', '[REDACTED]');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$itemsPerPage=[25, 50, 100, 250, 500, 1000];


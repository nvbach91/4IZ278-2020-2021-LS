<?php require __DIR__ . '/config/global.php'; ?>
<?php
// nenahravat username a password, ani dbname na git!
$db = new PDO(
    'mysql:host=localhost;dbname='.DB_DATABASE.';charset=utf8mb4', 
    DB_USERNAME, 
    DB_PASSWORD
);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
?>
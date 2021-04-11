<?php
// pripojeni do db
require './_inc/config.php';

// pristup jen pro admina
require 'admin_required.php';

$stmt = $connect->prepare('DELETE FROM goods WHERE id=?');
$stmt->execute([$_GET['id']]);

header('Location: index.php');

?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8" />
    <title>PHP Shopping App</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>

</body>

</html>

<?php

if (!empty($_POST)) {

    $pdo = new PDO(
        "mysql:host=localhost;dbname=test;charset=utf8mb4",
        "root",
        "",
    );

    $sql = "SELECT * FROM test WHERE name = " . $_POST['name'] . ";";
    // "SELECT * FROM test WHERE name = 0; DROP TABLE test; --;"
    //0; DROP TABLE test; --
    $statement = $pdo->prepare($sql);
    $statement->execute();

    $results = $statement->fetchAll(PDO::FETCH_ASSOC);

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="." method="POST">
        <input name="name" placeholder="filter by name">
        <button>Send</button>
    </form>
    <pre>
        <?php isset($results) ? var_dump($results) : ''; ?>
    </pre>
</body>
</html>
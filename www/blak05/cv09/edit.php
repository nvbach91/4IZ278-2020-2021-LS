<?php require __DIR__ . '/db.php' ?>
<?php require __DIR__ . '/auth.php' ?>
<?php require __DIR__ . '/auth2.php' ?>
<?php 
    if (!empty($_POST)) {
        $id = $_GET['id'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $description = $_POST['description'];

       $sql = "UPDATE goods SET name=?, price=?, description=? WHERE id= $id";
       $pdo->prepare($sql)->execute([$name, $price, $description]);

       $pageOffset = @$_COOKIE['offset'];
       header("Location: index.php?offset=$pageOffset");
    }
?>
<?php

    $id = $_GET['id'];
    $sql= "SELECT * FROM goods WHERE id = $id ";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $good = $statement->fetch();

?>
<?php require __DIR__ . '/incl/header.php'; ?>
    <title>Edit</title>
    <style>
        .boxik{
            max-width: 400px;
            margin: 5.5rem auto;
            padding: 20px;
        }
        button{
            margin-top: 0.5rem;
        }
        textarea{
            height: 200px;
        }
    </style>
</head>
<body>
<?php require __DIR__ . '/incl/navbar.php'; ?>
<div class="border p3 mb-4 boxik text-center">
    <form action="#" method="POST">
        <label class="form-label">Name:</label>
        <input name="name" class="form-control" type="name" value="<?php echo $good["name"]?>">
        <label class="form-label">Price:</label>
        <input name="price" class="form-control" type="price" value="<?php echo $good['price']?>">
        <label class="form-label">Description:</label>
        <textarea name="description" class="form-control" type="textarea"><?php echo $good['description']?></textarea>
        <button type="submit" class="btn btn-dark">Odeslat</button>
    </form>
    </div>
    <?php require __DIR__ . '/incl/footer.php'; ?>
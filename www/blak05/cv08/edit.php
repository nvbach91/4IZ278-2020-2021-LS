<?php require __DIR__ . '/db.php' ?>
<?php 
    if (!empty($_POST)) {
        $id = $_GET['id'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $description = $_POST['description'];

       $sql = "UPDATE goods SET name=?, price=?, description=? WHERE id= $id";
       $pdo->prepare($sql)->execute([$name, $price, $description]);

        header("Location: index.php");
    }
?>
<?php

    $id = $_GET['id'];
    $sql= "SELECT * FROM goods WHERE id = $id ";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $good = $statement->fetch();

?>
<!doctype html>
<html lang="en">
  <head>
    <title>Edit</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./incl/style.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

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
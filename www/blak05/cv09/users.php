<?php require __DIR__ . '/db.php' ?>
<?php require __DIR__ . '/auth.php' ?>
<?php require __DIR__ . '/auth2.php' ?>
<?php 
    if (!empty($_POST)) {
        $id = $_POST['id'];
        $email = $_POST['email'];
        $privilege = $_POST['privilege'];

        $sql = "UPDATE users SET email=?, privilege=? WHERE id= $id";
        $pdo->prepare($sql)->execute([$email, $privilege]);

        header("Location: users.php");
    }
?>
<?php

    $sql= "SELECT * FROM users";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $users = $statement->fetchAll(PDO::FETCH_ASSOC);

?>
<?php require __DIR__ . '/incl/header.php'; ?>
    <title>Users</title>
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
<div class="border boxik text-center">
<h1 class="text-center">Editing Users </h1>
    <?php foreach($users as $user): ?>
    <form action="#" method="POST">
        <label class="form-label">ID:</label>
        <input name="id" class="form-control" type="id" value="<?php echo $user['id']?>" readonly>
        <label class="form-label">Email:</label>
        <input name="email" class="form-control" type="email" value="<?php echo $user["email"]?>">
        <label class="form-label">Privilege:</label>
        <input name="privilege" class="form-control" type="privilege" value="<?php echo $user['privilege']?>">
        <button type="submit" class="btn btn-dark">Odeslat</button>
    </form>
    <?php endforeach ?>
    </div>
    <?php require __DIR__ . '/incl/footer.php'; ?>
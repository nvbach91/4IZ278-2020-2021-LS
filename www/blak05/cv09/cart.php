<?php require __DIR__ . '/db.php' ?>
<?php require __DIR__ . '/auth.php' ?>
<?php 
    session_start();

    if(!isset($_SESSION['cart'])){
        $_SESSION['cart'] = [];
    }

    if(count($_SESSION['cart']) >= 1){
        $sqlAll= "SELECT * FROM goods WHERE id IN (" . implode(",",$_SESSION['cart']) .") ORDER BY name ";
        $statement = $pdo->prepare($sqlAll);
        $statement->execute();
        $goods = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    else{
        $goods = [];
    }

?>

<?php require __DIR__ . '/incl/header.php'; ?>
    <title>Your Cart</title>
    <style>
        #main{
            margin: 90px 0;
        }
    </style>

</head>
<body>
<?php require __DIR__ . '/incl/navbar.php'; ?>
    <div id="main">
        <h2 class="text-center"><?php echo empty($goods) ? "Your cart is empty" : "Your cart"; ?></h2>
        <div style="max-width: 600px; margin: 0 auto;">
            <ol class="list-group list-group-numbered">
                <?php foreach($goods as $good): ?>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <div class="fw-bold"><?php echo $good['name']?></div>
                        <a href="remove-item.php?id=<?php echo $good['id']?>">Remove from cart</a>
                    </div>
                    <a href="remove-item.php?id=<?php echo $good['id']?>">
                        <span class="badge bg-danger rounded-pill">X</span>
                    </a>
                </li>
                <?php endforeach; ?>
            </ol>
        </div>
        <br>
        <?php $pageOffset = @$_COOKIE['offset']; ?>
        <div class="text-center"><a href="index.php?offset=<?php echo $pageOffset ?>">Go back</a></div>
    </div>
    <?php require __DIR__ . '/incl/footer.php'; ?>
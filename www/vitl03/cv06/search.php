<?php

require __DIR__ . '/SearchDB.php';
?>
<?php

$searchDB = new SearchDB();
$results = $searchDB->fetchAll();





?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>E-shop</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/shop-homepage.css" rel="stylesheet">

</head>

<?php include __DIR__ . '/includes/header.php' ?>



<body>
    <?php require __DIR__ . '/includes/navigation.php'; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <div class="col-lg-3">

                <h1 class="my-4">Fruit shop</h1>
                <?php include __DIR__ . '/includes/CategoryDisplay.php' ?>

            </div>
            <!-- /.col-lg-3 -->
            <div class="row">
                <?php foreach ($results as $result) : ?>
                    <div class="col-lg-12 col-md-6 mb-4">

                        <div class="card h-100">

                            <a href="search.php?id=<?php echo $result['product_id']; ?>"><img class="class-img-top" src="<?php echo $result['img']; ?>" width="200" height="160" alt="img"></img></a>
                            <div class="card-body">
                                <h4 class="card-title">
                                    <a href="search.php?id=<?php echo $result['product_id']; ?>"> <?php echo $result['name']; ?></a>
                                </h4>
                                <h5> <?php echo $result['price'] . ' ' . CURRENCY; ?></h5>
                                <div>
                                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!</p>
                                    <a class="btn btn-success " href="search.php?id=<?php echo $result['product_id']; ?>">Buy this product</a>
                                    <a class="btn btn-warning " href="#>">Edit this product</a>
                                    <a class="btn btn-outline-danger " href="delete.php?id=<?php echo $result['product_id']; ?>">Delete this product</a>
                                </div>

                            </div>

                            <a class="btn btn-secondary" href="index.php">Back</a>

                        </div>


                    </div>

                <?php endforeach; ?>



            </div>




            <!-- /.col-lg-9 -->

        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->
    <?php include __DIR__ . '/includes/footer.php' ?>
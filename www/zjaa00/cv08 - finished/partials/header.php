<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>cv08</title>

  <!-- icon and fonts -->
  <link rel="icon" href="img/donut.png" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css" integrity="sha512-oHDEc8Xed4hiW6CxD7qjbnI+B07vDdX7hEPTvn9pSZO1bcRqHp8mj9pyr+8RVC2GmtEfI2Bi9Ke9Ass0as+zpg==" crossorigin="anonymous" />

  <link rel="stylesheet" href="css/style.css">

  <!--[if lt IE 9]>
    <!script src="http://html5shim.googlecode.com/svn/trunk/html5.js">
    </!script> <![endif]-->

</head>

<nav>
  <a href="index.php">Home</a>
  <a href="cart.php">Cart</a>
  <?php if (@$_COOKIE['username']): ?>
        <a href="signout.php">Logout <?php echo $_COOKIE['username']; ?></a>
    <?php else: ?>
        <a href="signin.php">Login</a>
    <?php endif; ?>
</nav>

<body>
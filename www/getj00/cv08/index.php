
<?php
const TD = '</td><td>';
const MAXPRICE = 10000;
const LIMIT = 10;
const OFFSET = 0;
$maxPrice = isset($_GET['budget']) ? intval($_GET['budget']) : MAXPRICE;
$limit = isset($_GET['limit']) ? intval($_GET['limit']) : LIMIT;
if($limit == 0) $limit = LIMIT;
$offset = isset($_GET['offset']) ? intval($_GET['offset']) : OFFSET;

// is local to the server this is running on
$pdo=new PDO('mysql:host=localhost;dbname=test;charset=utf8mb4', 'getj00', 'xxx');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

// There is a bug that quotes numbers and MariaDB then complains
// https://bugs.php.net/bug.php?id=44639
// intval() above seems to make it relatively safe from SQL injection

$sql1 = "SELECT * FROM goods WHERE price <= :maxPrice ORDER BY name LIMIT $limit OFFSET $offset";
$stmt1 = $pdo->prepare($sql1);
$stmt1->execute([
    'maxPrice' => $maxPrice,
    //'lim' => $limit,
    //'off' => $offset
]);

$count = $pdo->prepare("select count(id) as count_id from goods");
$count->execute();

$sql2 = "SELECT * from products_eshop WHERE price <= :maxPrice";
$stmt2 = $pdo->prepare($sql2);
$stmt2->execute(['maxPrice' => isset($_GET['budget']) ? $_GET['budget'] : MAXPRICE]);

$sql3 = "SELECT name FROM categories_eshop WHERE category_id = :catid";
$stmt3 = $pdo->prepare($sql3);

/*
goods:
id, name, img, price, description
*/

if(isset($_POST['username'])){
    setcookie('username', $_POST['username'], time() + 3600);
}

?>

<?php include '_header.php'; ?>

<h1> Some mangos </h1>
<br>
<form method="POST" align="center" width="320px">
    <label for="Username" class="form-label">Username:</label>
    <input name="username" value="" class="form-control" id="Username">
    <button type="register" class="btn btn-primary">Set cookie</button>
</form>
<form align="center" width="320px">
    <label for="Budget" class="form-label">Budget (0 ~ 10000):</label>
    <input name="budget" type="number" class="form-control" min="0" max="10000" step="1" id="Budget" value="<?php isset($budget) ? $budget : MAXPRICE; ?>" defaultValue="<?= MAXPRICE ?>"/>
    <button type="register" class="btn btn-primary">Filter</button>
</form>
<br>


<div align="center">Items per page: 

<?php

echo "<a href=\"index.php?limit=5&offset=$offset&budget=$maxPrice\"> 5 </a> ";
echo "<a href=\"index.php?limit=10&offset=$offset&budget=$maxPrice\"> 10 </a> ";
echo "<a href=\"index.php?limit=20&offset=$offset&budget=$maxPrice\"> 20 </a> ";
echo "<a href=\"index.php?limit=50&offset=$offset&budget=$maxPrice\"> 50 </a> ";
?>

<br><br>Page: 

<?php

$countVal = 0; // this is haunted, offset 0 appears in print_r but is undefined
foreach($count->fetchAll() as $countRow){
    $countVal = $countRow['count_id'];
}

for ($i = 0; $i < $countVal / $limit; $i++){
    $eachOffset = $limit * $i;
    $pageNum = $i + 1; // pages don't start at 0
    echo "<a href=\"index.php?limit=$limit&offset=$eachOffset\"> $pageNum </a> ";
}

/*
    
body{ display: flex;}
.good {width: 25%;}
.image{
    background-position:
    background-repeat:
    background-size:
    width: 100px;
}
.pagination {
padding: 5px;
background-color: aquamarine;
margin-left: 5px;
color: white;
}
.pagination.active{
background-color:firebrick;
}


login: jen username, ulozit do cookies
setcookie('username', $username, time() + 3600)
header(Location: shop.php)

div class good
div class image  style bgimg: url echo image
div class name echo name v- price, description

*/
    
?>
<br><br>
</span>
<table>
<thead> <tr> <td>Cover Image</td> <td>Name</td> <td class="limitwidth">Description</td> <td>Product ID</td> <td>Price</td> </tr></thead>
<?php

foreach ($stmt1->fetchAll() as $row){
    echo '<tr>';
    echo '<td> <img href="' . $row['img'] . '"/>'. TD . $row['name'] . TD . $row['description'] . TD . $row['id'] . TD . $row['price'] . '</td>';
    echo '</tr>';
}

?>
</table>

<br>

<?php include '_footer.php'; ?>



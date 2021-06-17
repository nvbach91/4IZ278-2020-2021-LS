<?php 
session_start();

require __DIR__ . '/database_connection.php';
$where = "";

if(isset($_GET['category'])){
  if(!empty($_GET['category'])){
    $category = $_GET['category'];
    $where .= "and cat.id = '".$_GET['category']."'";
    $sqlcat = "SELECT name from product_category where id = $category";
    $cat = $pdo->prepare($sqlcat);
    $cat->execute();
    $catname = $cat->fetchAll();
  }
}
if(isset($_GET['university'])){
  if(!empty($_GET['university'])){
    $university = $_GET['university'];
    $where .= "and uni.id = '".$_GET['university']."'";
    $sqluni = "SELECT name from university where id =  $university";
    $uni = $pdo->prepare($sqluni);
    $uni->execute();
    $uniname = $uni->fetchAll();
  }
}
if(isset($_GET['dormitory'])){
  if(!empty($_GET['dormitory'])){
    $dormitory = $_GET['dormitory'];
    $where .= "and dorm.id = '".$_GET['dormitory']."'";
    $sqldorm = "SELECT name from dormitory where id = $dormitory";
    $dorm = $pdo->prepare($sqldorm);
    $dorm->execute();
    $dormname = $dorm->fetchAll();
  }
}

if(isset($_SESSION['id'])){
  $sql = "SELECT distinct pro.*,bor.id_user as bor_user,uni.id as university_id, uni.name as university_name,dorm.id as dormitory_id, dorm.name as dormitory_name, cat.id as category_id, cat.name as category_name 
  FROM product pro 
  left join university uni on uni.id = pro.id_university 
  left join dormitory dorm on dorm.id = pro.id_dormitory 
  left join borrowing bor on bor.id_user = pro.id_user
  left join product_category cat on cat.id = pro.id_category where pro.id_user != '".$_SESSION['id']."' and pro.id_state=1 $where";
}else{
  $sql = "SELECT pro.*,uni.id as university_id, uni.name as university_name,dorm.id as dormitory_id, dorm.name as dormitory_name, cat.id as category_id, cat.name as category_name FROM product pro 
  left join university uni on uni.id = pro.id_university 
  left join dormitory dorm on dorm.id = pro.id_dormitory 
  left join product_category cat on cat.id = pro.id_category where pro.validity=1 and pro.id_state=1 $where";
}   
     $statement = $pdo->prepare($sql);
    $statement->execute();
    $results = $statement->fetchAll();


    // print_r($results);
    $sql = "SELECT * FROM university";
    $statuni = $pdo->prepare($sql);
    $statuni->execute();

    $university = $statuni->fetchAll();

    $sql = "SELECT * FROM product_category";
    $statcat = $pdo->prepare($sql);
    $statcat->execute();

    $category = $statcat->fetchAll();

?>

<?php include './includes/header.php'?> 
<?php include './includes/navigation.php'?> 
<div class="center-text">
        <h1>Zboží</h1>
    </div>
    <?php include './includes/search.php'?> 

          <br>
    <div class="tablediv">
            <div class="rowdiv">
            <div class= "celldiv">

            </div>
            <div class= "celldiv">
            <p>Název</p>
            </div>
            <div class= "celldiv">
            <p>Cena</p>
            </div>
            <div class= "celldiv">
            <p>Popis</p>
            </div>
            <div class= "celldiv">
            <p>Univerzita</p>
            </div>
            <div class= "celldiv">
            <p>Kolej</p>
            </div>
            <div class= "celldiv">
            <p>Kategorie</p>
            </div>
            </div>
            </div><br>

        <?php foreach($results as $result): ?>
          <div class="tablediv">
            <div class="rowdiv">
            <div class= "celldiv">
              <img  width="100" height="100"  src="<?php echo $result['image']; ?>" alt="<?php echo $result['name']; ?>">     
              </div>
              <div class= "celldiv">
                  <p><?php echo $result['name']; ?></p>      
              </div>
              <div class= "celldiv">
               <?php echo $result['price']; ?>
               </div>
               <div class= "celldiv">
                <?php echo $result['description']; ?>
               </div>
               <div class= "celldiv">
                  <p><a href="./index.php?university=<?php echo $result['university_id']; ?>"><span class=""></span><?php echo $result['university_name']; ?></a></p>      
              </div>
               <div class= "celldiv">
                  <p><a href="./index.php?dormitory=<?php echo $result['dormitory_id']; ?>"><span class=""></span><?php echo $result['dormitory_name']; ?></a></p>      

              </div>
               <div class= "celldiv">
                  <p><a href="./index.php?category=<?php echo $result['category_id']; ?>"><span class=""></span><?php echo $result['category_name']; ?></a></p>      

              </div>
                <div class= "celldiv">
                <a href="./product.php?type=2&id=<?php echo $result['id']?>" class="btn btn-primary"><span class=""></span> Podrobnosti</a>
                </div>

            </div>
          </div>
          <br>
          <?php endforeach; ?>
<?php include './includes/footer.php'?>
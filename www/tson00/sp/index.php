<?php 
session_start();

require __DIR__ . '/database_connection.php';
$where = "";
if(isset($_POST['category'])){
  if(!empty($_POST['category'])){
    $category = $_POST['category'];
    $where .= "and cat.id = '".$_POST['category']."'";
  }
}
if(isset($_POST['university'])){
  if(!empty($_POST['university'])){
    $where .= "and uni.id = '".$_POST['university']."'";
  }
}
if(isset($_POST['dormitory'])){
  if(!empty($_POST['dormitory'])){
    $where .= "and dorm.id = '".$_POST['dormitory']."'";
  }
}

if(isset($_SESSION['id'])){
  $sql = "SELECT distinct pro.*,bor.id_user as bor_user,uni.id as university_id, uni.name as university_name,dorm.id as dormitory_id, dorm.name as dormitory_name, cat.id as category_id, cat.name as category_name 
  FROM product pro 
  left join university uni on uni.id = pro.id_university 
  left join dormitory dorm on dorm.id = pro.id_dormitory 
  left join borrowing bor on bor.id_user = pro.id_user
  left join product_category cat on cat.id = pro.id_category where pro.id_user != '".$_SESSION['id']."' $where";
}else{
  $sql = "SELECT pro.*,uni.id as university_id, uni.name as university_name,dorm.id as dormitory_id, dorm.name as dormitory_name, cat.id as category_id, cat.name as category_name FROM product pro 
  left join university uni on uni.id = pro.id_university 
  left join dormitory dorm on dorm.id = pro.id_dormitory 
  left join product_category cat on cat.id = pro.id_category where pro.validity=1 $where";
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
    <form action="" method="POST" >
    <div class="center-text">

    <div class="tablediv">
            <div class="rowdiv">
            <div class= "celldiv">
            <label for="university" class="form-label">Univerzita</label>
      <select class="form-control" name="university" id="university" >
      <option value="" style="display:none"></option>  
        <?php foreach($university as $uni): ?>
          <option value="<?php echo $uni['id'];?>"><?php echo $uni['name']; ?></option>  
        <?php endforeach; ?>
      </select>
              </div>
              <div class= "celldiv">
              <label for="dormitory" class="form-label">Kolej</label>
      <select class="form-control" name="dormitory" id="dormitory" >
      <option value="" style="display:none"></option>  
      </select>
              </div>
              <div class= "celldiv">
              <label for="category" class="form-label">Kategorie</label>
      <select class="form-control" name="category" id="category" >
      <option value="" style="display:none"></option>  
        <?php foreach($category as $cate): ?>
          <option value="<?php echo $cate['id'];?>"><?php echo $cate['name']; ?></option>  
        <?php endforeach; ?>
      </select>
               </div>
               <button type="submit" class="btn btn-success">Hledej</button> 
               <a href="./index.php" class="btn btn-danger"><span class=""></span> Smazat</a>

            </div>

            </div>
            </div>
          </form>
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
                  <p><?php echo $result['university_name']; ?></p>      
              </div>
               <div class= "celldiv">
                  <p><?php echo $result['dormitory_name']; ?></p>      
              </div>
               <div class= "celldiv">
                  <p><?php echo $result['category_name']; ?></p>      
              </div>
                <div class= "celldiv">
                <a href="./product.php?type=2&id=<?php echo $result['id']?>" class="btn btn-primary"><span class=""></span> Podrobnosti</a>
                </div>

            </div>
          </div>
          <br>
          <?php endforeach; ?>
<?php include './includes/footer.php'?>
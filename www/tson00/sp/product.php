<?php 
session_start();
require __DIR__ . '/database_connection.php';

$message = "";
$price = "";
$description = "";
$alert="";
if(isset($_POST['changeproduct'])){
    $price = $_POST['price'];
    $description = $_POST['description'];
  

    if(!empty($price)){
            $update = "UPDATE product SET price='".$price."' WHERE id='".$_GET["id"]."'";
            $stat = $pdo->prepare($update);
            $stat->execute();
    }
    if(!empty($description)){
        $update = "UPDATE product SET description='".$description."' WHERE id='".$_GET["id"]."'";
        $stat = $pdo->prepare($update);
        $stat->execute();
    }
    $message = 'Uloženo';
}elseif(isset($_POST['borrowproduct'])){
  $id_product = @$_GET['id'];
  $sql = "SELECT * FROM borrowing WHERE id_product = :id_product and status != 1;";
  $statement = $pdo->prepare($sql);
  $statement->execute([
      'id_product' => $id_product,
  ]);

  $borstat = $statement->fetchAll();

  if(!empty($borstat)){
    $alert = "Zboží je již vypůjčené";
  }else{
    $sql = "INSERT INTO borrowing (id_product, id_user,status)  
    VALUES (?,?,?)";
    $status = 6;
    $statement = $pdo->prepare($sql);
    $statement->execute([$_GET['id'],$_SESSION['id'],$status]);

    $statepro = "UPDATE product SET id_state=2 WHERE id='".$_GET["id"]."'";
    $stat = $pdo->prepare($statepro);
    $stat->execute();

     header('Location: borrow.php');
  }
}







    $sql = "SELECT pro.*,uni.id as university_id, uni.name as university_name,dorm.id as dormitory_id, dorm.name as dormitory_name, cat.id as category_id, cat.name as category_name FROM product pro 
    left join university uni on uni.id = pro.id_university 
    left join dormitory dorm on dorm.id = pro.id_dormitory 
    left join product_category cat on cat.id = pro.id_category 
    where pro.id = '".$_GET['id']."'";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $results = $statement->fetchAll();

    // print_r($results);

?>

<?php include './includes/header.php'?> 
<?php include './includes/navigation.php'?> 
<?php if(!empty($message)){?>
  <div class="accept"><?php if($message!="") { echo $message; } ?></div>
<?php
}?>
<?php if(!empty($alert)){?>
  <div class="alert"><?php if($alert!="") { echo $alert; } ?></div>
<?php
}?>
<form action="" method="POST" >

    <?php if($_GET['type']==2){ ?>
      
  
       
          <?php foreach($results as $result): ?>
            <div class="center-text">
        <h1><?php echo $result['name']; ?> </h1>
        <img  width="100" height="100"  src="<?php echo $result['image']; ?>" alt="<?php echo $result['name']; ?>">  
        </div>
        <div class="center-text">
          <div class="container">
            <div class="row">
                
                  <div class="">

                  <label for="image" class="form-label">Cena</label>

               <p><?php echo $result['price']; ?></p>
               </div>      
               <div class="">

               <label for="image" class="form-label">Popis</label>

                <p><?php echo $result['description']; ?></p>
                </div>      
                <div class="">

                <label for="image" class="form-label">Univerzita</label>

                  <p><?php echo $result['university_name']; ?></p>      
                  </div>      
                  <div class="">

                  <label for="image" class="form-label">Kolej</label>

                  <p><?php echo $result['dormitory_name']; ?></p>      
                  </div>      
                  <div class="">

                  <label for="image" class="form-label">Kategorie</label>

                  <p><?php echo $result['category_name']; ?></p>    
                  </div>      
  
                  </div>         
            </div>
          </div>
          <?php endforeach; ?>

          <?php 
    }elseif($_GET['type']==1){ ?>
<?php foreach($results as $result): ?>
    <div class="center-text">
        <h1><?php echo $result['name']; ?> </h1>
        <img  width="100" height="100"  src="<?php echo $result['image']; ?>" alt="<?php echo $result['name']; ?>">  
        </div>
  
          <div class="container">  
                  <div class="">
                  <label for="cena" class="form-label">Cena</label>
                  <input  type="text" name="price" value="<?php echo $result['price']; ?>" class="form-control" id="cena" aria-describedby="cena" required>
               </div>      
               <div class="mb-3">

               <label for="image" class="form-label">Popis</label>
               <textarea id="description" name="description" rows="4"  class="form-control" cols="50"><?php echo $result['description']; ?></textarea>
                </div>      
                <div class="mb-3">

                <label for="image" class="form-label">Univerzita</label>
                  <p><?php echo $result['university_name']; ?></p>      
                  </div>      
                  <div class="mb-3">

                  <label for="image" class="form-label">Kolej</label>

                  <p><?php echo $result['dormitory_name']; ?></p>      
                  </div>      
                  <div class="mb-3">

                  <label for="image" class="form-label">Kategorie</label>

                  <p><?php echo $result['category_name']; ?></p>    
                  </div>      
  
            </div>
         
          <?php endforeach; ?>
<?php   }
    ?>

          <?php 
          if(isset($_SESSION['id'])){
            if($_GET['type']==1){?>
                <div class="center-button">  
                <button type="submit" class="btn btn-success">Uložit změny</button> 
                </div>
                <input  name="changeproduct" type="hidden">

                <?php
            }elseif($_GET['type']==2){
                ?>
                <div class="center-button">  
                <button type="submit" class="btn btn-success">Půjčit</button> 
                <input  name="borrowproduct" type="hidden">

                </div><?php
            }
          }else{
            ?>
            <div class="center-button">  
            <h2>Pro vypůjčení je potřeba udělat <a href="./registration.php?" class="btn btn-primary"><span class=""></span> Registrace</a> nebo <a href="./login.php?" class="btn btn-primary"><span class=""></span> Přihlašení</a></h2>                
            </div><?php
        }
          ?>
</form>
<?php include './includes/footer.php'?>
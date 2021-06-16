<?php require __DIR__ . '/database_connection.php'; ?>
<?php 
session_start();

$message = "";
$name ="";
$category ="";
$description ="";
$price ="";
$image ="";


if(isset($_POST['newproduct'])){
    $name =$_POST['name'];
    $category =$_POST['category'];
    $description =$_POST['description'];
    $price =$_POST['price'];
    $image =$_POST['image'];

    $sqlemail = "SELECT id_university,id_dormitory FROM user where id = '". $_SESSION["id"]."'";
    $statuser = $pdo->prepare($sqlemail);
    $statuser->execute();
    $userarray = $statuser->fetchAll();

    $state = 1;
    $id_user = $_SESSION["id"];
    $id_university = $userarray[0]['id_university'];
    $id_dormitory = $userarray[0]['id_dormitory'];

    $sql = "INSERT INTO product (name, id_university, id_dormitory,id_category,description,price,id_state,id_user,image)  
    VALUES (?,?,?,?,?,?,?,?,?)";
        $statement = $pdo->prepare($sql);
        $statement->execute([$name,$id_university,$id_dormitory,$category,$description,$price,$state,$id_user,$image]);
        header('Location: myproduct.php');
}

?>
<?php 



    $sql = "SELECT * FROM product_category";
    $statement = $pdo->prepare($sql);
    $statement->execute();

    $results = $statement->fetchAll();


    // print_r($results);

?>
<?php include './includes/header.php'?> 
<?php include './includes/navigation.php'?> 

<div class="container">
    <div class="center-text">
        <h1>Nové zboží</h1>
    </div>
  <form action="" method="POST" >
  <?php if(!empty($message)){?>
  <div class="alert"><?php if($message!="") { echo $message; } ?></div>
<?php
}?>
    <div class="mb-3">
      <label for="name" class="form-label">Název zboží</label>
      <input  name="newproduct" type="hidden">
      <input  type="text" name="name" value="" class="form-control" id="name" aria-describedby="name" required>
    </div>

    <div class="mb-3">
      <label for="category" class="form-label">Kategorie</label>
      <select class="form-control" name="category" id="category" required>
      <option value="" style="display:none"></option>  
        <?php foreach($results as $result): ?>
          <option value="<?php echo $result['id'];?>"><?php echo $result['name']; ?></option>  
        <?php endforeach; ?>
      </select>
    </div>
    <div class="mb-3">
      <label for="description" class="form-label">Popis</label>
      <textarea id="description" name="description" rows="4"  class="form-control" cols="50"></textarea>
    </div>
    <div class="mb-3">
      <label for="price" class="form-label">Cena</label>
      <input  type="text" name="price" value="" class="form-control" id="price" aria-describedby="price" required>
    </div>
    <div class="mb-3">
      <label for="image" class="form-label">URL obrázku</label>
      <input  name="image" type="text" class="form-control" id="image" aria-describedby="image" required>
    </div>
    <div class="center-button">  
    <button type="submit" class="btn btn-success">Přidat</button> 
    </div>
  </form>
</div>
<?php include './includes/footer.php'?>
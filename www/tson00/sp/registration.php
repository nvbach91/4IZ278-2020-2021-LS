<?php require __DIR__ . '/database_connection.php'; ?>
<?php 



    $sql = "SELECT * FROM university";
    $statement = $pdo->prepare($sql);
    $statement->execute();

    $results = $statement->fetchAll();


    // print_r($results);

?>
<?php include './includes/header.php'?> 
<?php include './includes/navigation.php'?> 

<div class="container">
    <div class="center-text">
        <h1>Registrace</h1>
    </div>
  <form action="action.php" method="POST" >

    <div class="mb-3">
      <label for="name" class="form-label">Jméno</label>
      <input  name="registration" type="hidden">
      <input  type="text" name="name" value="" class="form-control" id="name" aria-describedby="name" required>
    </div>
    <div class="mb-3">
      <label for="surname" class="form-label">Příjmení</label>
      <input  type="text" name="surname" value="" class="form-control" id="surname" aria-describedby="surname" required>
    </div>
    <div class="mb-3">
      <label for="university" class="form-label">Univerzita</label>
      <select class="form-control" name="university" id="university" required>
      <option value="" style="display:none"></option>  
        <?php foreach($results as $result): ?>
          <option value="<?php echo $result['id'];?>"><?php echo $result['name']; ?></option>  
        <?php endforeach; ?>
      </select>
    </div>
    <div class="mb-3">
      <label for="dormitory" class="form-label">Kolej</label>
      <select class="form-control" name="dormitory" id="dormitory" required>
      <option value="" style="display:none"></option>  
      </select>
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Heslo</label>
      <input  type="password" name="password" value="" class="form-control" id="password" aria-describedby="password" required>
    </div>
    <div class="mb-3">
      <label for="confirm" class="form-label">Heslo znovu</label>
      <input  type="password" name="confirm" value="" class="form-control" id="confirm" aria-describedby="confirm" required>
    </div>
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">E-mail</label>
      <input  name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
    </div>
    <div class="mb-3">
      <label for="username" class="form-label">Uživatelkské jméno</label>
      <input  type="text" name="username" value="" class="form-control" id="username" aria-describedby="username" required>
    </div>
    <div class="mb-3">
      <label for="phone" class="form-label">Telefon</label>
      <input  type="number" name="phone" value="" class="form-control" id="phone" aria-describedby="phone" required>
    </div>
    <div class="center-button">  
    <button type="submit" class="btn btn-primary">Registrace</button> 
    </div>
  </form>
</div>
<?php include './includes/footer.php'?>
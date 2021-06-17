<form action="" method="GET" >
<div class="center-text">

<div class="tablediv">
        <div class="rowdiv">
        <div class= "celldiv">
        <label for="university" class="form-label">Univerzita</label>
  <select class="form-control" name="university" id="university" >
  <option value="<?php echo isset($_GET['university']) ? $_GET['university']: ''?>" style="display:none"><?php echo isset($uniname) ? $uniname[0]['name']: ''?></option>  
    <?php foreach($university as $uni): ?>
      <option value="<?php echo $uni['id'];?>"><?php echo $uni['name']; ?></option>  
    <?php endforeach; ?>
  </select>
          </div>
          <div class= "celldiv">
          <label for="dormitory" class="form-label">Kolej</label>
  <select class="form-control" name="dormitory" id="dormitory" >
  <option value="<?php echo isset($_GET['dormitory']) ? $_GET['dormitory']: ''?>" style="display:none"><?php echo isset($dormname) ? $dormname[0]['name']: ''?></option>   
  </select>
          </div>
          <div class= "celldiv">
          <label for="category" class="form-label">Kategorie</label>
  <select class="form-control" name="category" id="category" >
  <option value="<?php echo isset($_GET['category']) ? $_GET['category']: ''?>" style="display:none"><?php echo isset($catname) ? $catname[0]['name']: ''?></option>  
    <?php foreach($category as $cate): ?>
      <option value="<?php echo $cate['id'];?>"><?php echo $cate['name']; ?></option>  
    <?php endforeach; ?>
  </select>
           </div>
           <button type="submit" class="btn btn-success">Hledej</button> 
           <a href="./index.php" class="btn btn-danger"><span class=""></span>Zrušit Filtry</a>

        </div>

        </div>
        </div>
      </form>

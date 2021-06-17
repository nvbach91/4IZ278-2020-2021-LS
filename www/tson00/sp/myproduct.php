<?php 
session_start();

require __DIR__ . '/database_connection.php';
    $sql = "SELECT pro.*, stat.id as stat_id, stat.state as stat_name FROM product pro 
    left join state stat on stat.id = pro.id_state
    where pro.id_user = '".$_SESSION["id"]."'";
    $statement = $pdo->prepare($sql);
    $statement->execute();

    $results = $statement->fetchAll();


    // print_r($results);

?>

<?php include './includes/header.php'?> 
<?php include './includes/navigation.php'?> 
<div class="center-text">
        <h1>Moje Zboží</h1>
    </div>
    <div class="center-text"><a href="./new_product.php?" class="btn btn-success"><span class=""></span> Nové zboží</a></div><br>

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

                <a href="./product.php?type=1&id=<?php echo $result['id']?>" class="btn btn-primary"><span class=""></span> Podrobnosti</a>
                </div>     

                <div class= "celldiv"> 

                <input type="button" class="btn btn-danger" id="delete" data-id = "<?php echo $result['id']?>" value = "Odstranit"> 
            </div>
          </div>
          </div>
          <br>

          <?php endforeach; ?>
          <div class="center-button">  
<script>
$(document).on("click", "#delete", function() { 
		var $ele = $(this).closest('.rowdiv');
		$.ajax({
			url: "deleteproduct.php",
			type: "POST",
			cache: false,
			data:{
				id: $(this).attr("data-id")
			},
			success: function(){
                    $ele.hide();
                

			}
		});
	});
</script>

<?php include './includes/footer.php'?>

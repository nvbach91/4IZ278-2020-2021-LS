<?php 
session_start();

require __DIR__ . '/database_connection.php';
    

    $sql ="SELECT bor.*, pro.id as id_product,pro.name name,stat.state as state,stat.id as state_id,
    us.email,pro.price as price,pro.description as description, pro.image as image from borrowing bor
            left join product pro on pro.id = bor.id_product
            left join user us on pro.id_user = us.id
            left join state stat on stat.id = bor.status
            where bor.id_user = '".$_SESSION["id"]."'";
    $statement = $pdo->prepare($sql);
    $statement->execute();

    $results = $statement->fetchAll();


    // print_r($results);

?>

<?php include './includes/header.php'?> 
<?php include './includes/navigation.php'?> 
<div class="center-text">
        <h1>Vypůjčky</h1>
    </div>

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
            <p>Email</p>
            </div>
            <div class= "celldiv">
            <p>Status</p>
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
                <?php echo $result['email']; ?>
                </div>    
                <div class= "celldiv"> 

                <?php 
                
                    echo $result['state'];
              
                
                ?>
                </div>   

                <?php               
                if($result['state_id'] !=4 && $result['state_id'] !=3){
                ?>
                <div class= "celldiv"> 

                <input type="button" class="btn btn-danger" id="unborrow" data-id = "<?php echo $result['id']?>" value = "Vratit"> 
            </div>
            <?php }?>
          </div>
          </div>
          <br>

          <?php endforeach; ?>
          <div class="center-button">  
<script>
$(document).on("click", "#unborrow", function() { 
		var $ele = $(this);
		$.ajax({
			url: "deleteborrow.php",
			type: "POST",
			cache: false,
			data:{
				id: $(this).attr("data-id")
			},
			success: function(){
                location.reload();   
                $ele.hide();
			}
		});
	});
</script>

<?php include './includes/footer.php'?>

<?php 
session_start();

require __DIR__ . '/database_connection.php';  
    $sql ="SELECT cat.name as category_name,dorm.name as dormitory_name,uni.name as university_name,bor.*, pro.id as id_product,pro.name name,stat.state as state,stat.id as state_id,
        us.email,pro.price as price,pro.description as description, pro.image as image from borrowing bor
        left join product pro on pro.id = bor.id_product
            left join user us on bor.id_user = us.id
            left join state stat on stat.id = bor.status 
            left join university uni on pro.id_university = uni.id 
            left join dormitory dorm on pro.id_university = dorm.id 
            left join product_category cat on cat.id = pro.id_category 

            where bor.status = 3
            ";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $results = $statement->fetchAll();
?>

<?php include './includes/header.php'?> 
<?php include './includes/navigation.php'?> 
<div class="center-text">
        <h1>Statistika</h1>
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
            <p>Email</p>
            </div>
            <div class= "celldiv">
            <p>Status</p>
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
            <div class= "celldiv">
            <p>Datum</p>
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
                    <?php echo $result['email']; ?>
                </div>    
                <div class= "celldiv"> 
                    <?php echo $result['state']; ?>
                </div>   
                <div class= "celldiv"> 
                    <?php echo $result['university_name']; ?>
                </div> 
                <div class= "celldiv"> 
                    <?php echo $result['dormitory_name']; ?>
                </div> 
                <div class= "celldiv"> 
                    <?php echo $result['category_name']; ?>
                </div> 
                <div class= "celldiv"> 
                    <?php 
                    $phpdate = strtotime($result['date_borrow']);
                    echo  date( 'd/m/Y h:m', $phpdate );?>
                </div> 
            </div>
          </div>
          <?php endforeach; ?>
</script>

<?php include './includes/footer.php'?>

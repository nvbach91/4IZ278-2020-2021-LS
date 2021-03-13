

<?php include '_header.php'; ?>

<?php require 'formhandling.php' ?>

<h1>*** R E G I S T R A T I O N ***</h1>

<?php if(!$isSub) include 'formRegister.php'; 
    $register = true;
?>

<?php if($isSub): ?>

    <?php
        if(isset($succMsg)){
            echo "<h2>$succMsg</h2><br><br>"; //valid form, but ...
            if(makeRegistration($_POST)){ 
                header("Location: login.php?nick=$nick");
            }else{
                echo '<p>This user already exists. Register with a different nickname.</p>';
                include 'formRegister.php';
            }
        }
        if(!empty($inputErrors)){
            foreach($inputErrors as $i){
                echo "<p> $i </p>";
            }
            include 'formRegister.php';
        }
        
        ?>
   
<?php endif; ?>

<?php include '_footer.php'; ?>



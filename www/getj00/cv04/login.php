

<?php include '_header.php'; ?>

<?php require 'formhandling.php'; ?>

<h1>*** L O G I N ***</h1>

<?php if(!$isSub) include 'formLogin.php'; 
    $register = false;
?>

<?php if($isSub): ?>

    <?php
        if(isset($succMsg)){
            echo "<h2>$succMsg</h2><br><br>";
            if(makeLogin($_POST)){
                echo "<p>Login successful. However, there's nothing on this site.</p>";
                // Header redirect to some portal maybe here.
            }else{
                echo "<p>Login failed. Either this nickname isn't registered or the password is wrong.</p>";
                include 'formLogin.php';
            }
        }
        if(!empty($inputErrors)){
            foreach($inputErrors as $i){
                echo "<p> $i </p>";
            }
            include 'formLogin.php';
        }
        
    ?>
   
<?php endif; ?>

<?php include '_footer.php'; ?>



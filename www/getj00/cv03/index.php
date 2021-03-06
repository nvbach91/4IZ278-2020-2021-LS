<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>PokéMagic Tourney Registration</title>
	
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="style.css" />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</head>
<body>

<?php require 'formhandling.php' ?>

<?php if(!$isSub) include 'form.php'; ?>

<?php if($isSub): ?>

    <?php
        if(isset($succMsg)){
            echo "<h2>$succMsg</h2><br><br>";
        }
        if(!empty($inputErrors)){
            foreach($inputErrors as $i){
                echo "<p> $i </p>";
            }
            include 'form.php';
        }else{
            echo '<h3>Summary:</h3>';
            echo "1st Name: $name1 <br> Middle Name: $name2 <br> Last Name: $name3 <br><br>"; 
            echo "Nickname: $nick <br> Avatar: <br><image href=\"$avatar\" /> <br><br>";
            echo "Sex: $sex <br> Chromosomes: $chrom <br> Date of Birth: $dob <br> Language: $lang <br><br> ";
            echo "E-mail: $email <br> Phone: $phone <br><br>";
            echo "Deck type: $deckType <br> Deck Size: $deckSize <br> Crypto type: $cryptoType <br> Crypto address: $cryptoAddr <br><br>";
        }
        
        ?>
   
<?php endif; ?>
    <br><br><p><i>ikr looks ugly af but meh</i></p>
</body>	
</html>


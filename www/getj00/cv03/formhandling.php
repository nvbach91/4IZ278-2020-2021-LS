<?php
    $inputErrors = [];
    $isSub = !empty($_GET);
    
    if($isSub){
        // Obtain individual fields 
        $name1 = htmlspecialchars($_GET['name1']);
        $name2 = htmlspecialchars($_GET['name2']);
        $name3 = htmlspecialchars($_GET['name3']);
        
        $nick = htmlspecialchars($_GET['nick']);
        $avatar = htmlspecialchars($_GET['avatar']);
        //$avatarFile = htmlspecialchars($_GET['avatarFile']);
        
        if(isset($_GET['sex'])){
            $sex = $_GET['sex'];
        }
        
        $chrom = htmlspecialchars($_GET['chrom']);
        $dob = htmlspecialchars($_GET['dob']);
        $lang = htmlspecialchars($_GET['lang']);
        $email = htmlspecialchars($_GET['email']);
        $phone = htmlspecialchars($_GET['phone']);
        
        $deckType = ($_GET['deckType']);
        $deckSize = ($_GET['deckSize']);
        $cryptoType = ($_GET['cryptoType']);
        $cryptoAddr = htmlspecialchars($_GET['cryptoAddr']);
        
        if(isset($_GET['agree'])){
            $agree = $_GET['agree'] ? true : false;
        }else{
            array_push($inputErrors, "Agreeing to receive spam ever after is required.");
        }
        
        
        // Check required fields
        if(!$name1){
            array_push($inputErrors, "1st name is required.");
        }
        if(!$name3){
            array_push($inputErrors, "Last name is required.");
        }
        if(!$dob){
            array_push($inputErrors, "Date of birth is required.");
        }
        if(!$email){
            array_push($inputErrors, "E-mail address is required.");
        }
        if(!$deckType){
            array_push($inputErrors, "Deck type is required.");
        }
        if(!$cryptoType){
            array_push($inputErrors, "Cryptocurrency wallet type is required.");
        }
        if(!$cryptoAddr){
            array_push($inputErrors, "Cryprocurrency wallet address is required.");
        }
        
        // Validate
        if($avatar && !filter_var($avatar, FILTER_VALIDATE_URL)){
            array_push($inputErrors, "Incorrect avatar URL format.");
        }
        if($chrom && !preg_match('/^[XY0]+$/', $chrom) && !preg_match('/^[ZW0]+$/', $chrom)){
            array_push($inputErrors, "Chromosome configuration must either use the X/Y/0 system, or the Z/W/0 one.");
        }
        if($dob && !preg_match('/^[0-9]{4}-[01][0-9]-[0-3][0-9]$/', $dob)){ // maybe disallow things like 0001-19-39
            array_push($inputErrors, "Date of birth must be in ISO format.");
        }
        if($email && !filter_var($email, FILTER_VALIDATE_EMAIL)){
            array_push($inputErrors, "Incorrect e-mail format.");
        }
        if($phone && !preg_match('/\+?[0-9]+([\- ]?[0-9])+/', $phone)){
            array_push($inputErrors, "Incorrect phone number format.");
        }
        
        if(!count($inputErrors)){
            $succMsg = '"Registered" sucessfully.';
        }
    }
?>

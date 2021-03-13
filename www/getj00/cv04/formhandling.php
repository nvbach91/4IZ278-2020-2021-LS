<?php
    $inputErrors = [];
    $isSub = !empty($_POST);
    $register = false;
    
    function makeRegistration($data){ // returns boolean
        $userExists = false;
        
        // horrible copypasta
        $nick = htmlspecialchars($data['nick']);
        $avatar = htmlspecialchars($data['avatar']);
        $dob = htmlspecialchars($data['dob']);
        $email = htmlspecialchars($data['email']);
        $pass = htmlspecialchars($data['pass']);
        
        $readback = file('users.db'); // posledni radek bude prazdny
        foreach($readback as $line){
            if(!$line) continue;
            $exline = explode(';', $line);
            if($exline[0] == $nick){
                $userExists = true;
            }
        }
        if(!$userExists){
            //implode(oddelovac,pole)
            $newRecord = "$nick;$email;$avatar;$dob;$pass\r\n";
            file_put_contents('users.db', $newRecord, FILE_APPEND);
            sendMail($email, 'Cv04 test registration success', "
                <h1>Registration confirmation</h1>
                <p>
                    Welcome, $nick. Thanks for registering. <br>
                    <img href=\"$avatar\">
                </p>
            ");
            return true;
        }else{
            return false;
        }
    }
    
    function sendMail($email, $subject, $message){ // send only to school mail addresses
        $headers = [
            'MIME-Version: 1.0',
            'Content-type: text/html, charset=utf-8',
            'From: noreply@cv04testapp.cz',
            'Reply-To: complaints@cv04testapp.cz',
            'X-Mailer: PHP/8.0'
        ];
        return mail($email. $subject, $message, implode('\n', $headers));
    }
    
    function makeLogin($data){
        
        $nick = htmlspecialchars($data['nick']);
        $pass = htmlspecialchars($data['pass']);
        
        $readback = file('users.db'); // posledni radek bude prazdny
        foreach($readback as $line){
            if(!$line) continue;
            $exline = explode(';', $line);
            if($exline[0] == $nick && $exline[4] == $pass){
                return true;
            }
        }
        return false;
    }
    
    
    if($isSub){
        // Obtain individual fields 
        $nick = htmlspecialchars($_POST['nick']);
        $pass = htmlspecialchars($_POST['pass']);
        if($register){
            $avatar = htmlspecialchars($_POST['avatar']);
            $dob = htmlspecialchars($_POST['dob']);
            $email = htmlspecialchars($_POST['email']);
            $confirm = htmlspecialchars($_POST['confirm']);
            if(isset($_POST['agree'])){
                $agree = $_POST['agree'] ? true : false;
            }else{
                array_push($inputErrors, "Agreeing to receive spam ever after is required.");
            }
        }
        
        // Check required fields
        if(!$nick){
            array_push($inputErrors, "Nickname is required.");
        }
        if(!$pass){
            array_push($inputErrors, "Password is required, and it cannot be an empty string.");
        }
        if($register){
            if(!$dob){
                array_push($inputErrors, "Date of birth is required.");
            }
            if(!$email){
                array_push($inputErrors, "E-mail address is required.");
            }
            
            // Validate
            if($avatar && !filter_var($avatar, FILTER_VALIDATE_URL)){
                array_push($inputErrors, "Incorrect avatar URL format.");
            }

            if($dob && !preg_match('/^[0-9]{4,}-[01][0-9]-[0-3][0-9]$/', $dob)){ // maybe disallow things like 0001-19-39
                array_push($inputErrors, "Date of birth must be in YYYY-MM-DD format.");    
            }else if($dob && explode('-', $dob)[0] == '0000'){
                array_push($inputErrors, "Year 0 doesn't exist.");
            }
            
            if($email && !filter_var($email, FILTER_VALIDATE_EMAIL)){
                array_push($inputErrors, "Incorrect e-mail format.");
            }
            if($pass != $confirm){
                array_push($inputErrors, "Password wasn't confirmed correctly.");
            }
        }
        
        if(!count($inputErrors)){
            if($register){
                $succMsg = 'Registeration form received sucessfully.';
            }else{
                $succMsg = 'Login form received successfuly.';
            }
        }
    }
?>

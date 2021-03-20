<?php

$invalidInputs = [];

function sendEmail($email, $subject, $message)
 {
     $header = [
         'MIME-Version_ 1.0',
         'Content-type: text/html, charset=utf-8',
         'From: blak05@dev.com',
         'Reply-To: app@dev.com',
         'X-Mailer: PHP/8.0',
     ];
     $body = "
         <h1>$subject</h1>
         <p>$message</p>
     ";
     return mail($email, $subject, $body, implode("\r\n", $headers));
}

function makeRegistration($data){
    $databaseFileName = __DIR__ . '/database/users.db';
    $lines = file($databaseFileName);
    $message = "";
    $isExistingUser = false;
    $success = false;
    foreach($lines as $line){
        if(!$line){
            continue;
        }
        $fields = explode(';', $line);
        $user = [
            'name' => $fields[0],
            'email' => $fields[1],
            'password' => $fields[2],
        ];

        if($user['name'] === $data['name']){
            $isExistingUser = true;
            break;
        }
        if($user['email'] === $data['email']){
            $isExistingUser = true;
            break;
        }

    }

    if($isExistingUser){
        $message = "Uživatel již existuje";
    }

    if(!$isExistingUser){

        $userInfo = [
            $data['name'],
            $data['email'],
            $data['password'],
        ];
        //vyrobit záznam 
        $newRecord = implode(';', $userInfo) . "\r\n";

    //vložit do souboru
        file_put_contents($databaseFileName, $newRecord, FILE_APPEND);
        $message = "Registrace hotova!";
        $success = true;
    }

    $result = [
        'success' => $success,
        'message' => $message
    ];

    return $result;
}

if(!empty($_POST)){
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars($_POST['password']);
    $conf = htmlspecialchars($_POST['confirm']);

    if($password !== $conf){
        array_push($invalidInputs, 'Hesla se neshodují');
    }
    if(empty($name)){
        array_push($invalidInputs, 'Doplňte prosím jméno');
    }
    if(empty($email)){
        array_push($invalidInputs, 'Doplňte prosím email');
    }
    if(empty($password) || empty($conf)  ){
        array_push($invalidInputs, 'Doplňte prosím heslo');
    }

    if(empty($invalidInputs)){
        //provest registraci
        $registrationResult = makeRegistration($_POST);
        if($registrationResult['success'] === true ){
            array_push($invalidInputs, $registrationResult['message']);
            //poslat mail o vytvoření účtu
            sendEmail($email, 'Registrace dokončena!', 'Potvrzujeme úspěšné dokončení rezervace!');
            //presmerovat na login
            header("Location: login.php?email=$email");
        }else{
            array_push($invalidInputs, $registrationResult['message']);
        }
    }
}

?>

<?php include __DIR__ . "/incl/header.php" ?> 
    <main>
        <h1>Registration</h1>
        <?php include __DIR__ . "/incl/nav.php" ?> 
        <div class="form">
            <form method="POST" action="<?php $_SERVER['PHP_SELF'];?>"> 
                <label>Name:</label>
                <input name="name" value="<?php echo isset($name) ? $name : '' ?>"><br>
                <label>Email:</label>
                <input type="email" name="email" value="<?php echo isset($email) ? $email : '' ?>"><br>
                <label>Password:</label>
                <input type="password" name="password" ><br>
                <label>Confirm Password:</label>
                <input type="password" name="confirm"><br>
                <button>Register me</button>
            </form>
        </div>
        <?php foreach($invalidInputs as $message): ?>
            <div class="warning" style="display:block">
                <p><?php echo $message ?></p>
            </div>
        <?php endforeach ?>
    </main>
<?php include __DIR__ . "/incl/footer.php" ?> 
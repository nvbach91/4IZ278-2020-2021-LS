
<?php
    $invalidInputs = [];
    $mail = isset($_GET['email']) ? $mail = $_GET['email'] : '';

    function checkLogin($data){
        $databaseFileName = __DIR__ . "/database/users.db";
        $users = file($databaseFileName);
        foreach($users as $user){
            $lide = explode(';', $user);
            $user = [
                'name' => $lide[0],
                'email' => $lide[1],
                'password' => $lide[2],
            ];
            $dbMail = $user['email'];
            $dbPas = $user['password'];
            $formPas = $_POST['password'];
            $formMail = $_POST['email'];
            if(trim($dbPas) === $formPas && trim($dbMail) === $formMail){
                $result = ['success' => true, 'message' => 'Autorizace proběhla úspěšně'];
                break;
            }else{
                $result = ['success' => false, 'message' => 'Špatné údaje'];
            }
        }
        return $result;
    }

    if(!empty($_POST)){
        $email = htmlspecialchars(trim($_POST['email']));
        if(empty($email) && !isset($_GET['email'])){
            array_push($invalidInputs, "Je nutné zadat mail!");
        }
        $password = htmlspecialchars($_POST['password']);
        if(empty($password)){
            array_push($invalidInputs, "Je nutné zadat heslo!");
        }
    
        if(empty($invalidInputs)){
            //provest login
            $checkLoginResult = checkLogin($_POST);
            if($checkLoginResult['success'] === true ){
                //array_push($invalidInputs, $checkLoginResult['message']);
                //presmerovat na login
                header("Location: admin/users.php");
            }else{
                array_push($invalidInputs, $checkLoginResult['message']);
            }
        }
    }
?>
<?php include __DIR__ . "/incl/header.php" ?> 
    <main>
        <h1>Login</h1>
        <?php include __DIR__ . "/incl/nav.php" ?> 
        <div class="form">
            <form method="POST" action="<?php $_SERVER['PHP_SELF'];?>">
                <label>Email:</label>
                <input type="email" name="email" placeholder="<?php echo $mail?>">
                <label>Password:</label>
                <input type="password" name="password">
                <button>Log in</button>
            </form>
        </div>
            <?php foreach($invalidInputs as $message): ?>
            <div class="warning" style="display:block">
                <p><?php echo $message ?></p>
            </div>
            <?php endforeach ?>
    </main>
    <?php include __DIR__ . "/incl/footer.php" ?> 
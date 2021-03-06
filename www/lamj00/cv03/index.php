<?php 

$invalidInputs = [];
    $isSubmitted = !empty($_POST);
    $gender = 'N';
    
    if($isSubmitted) {
        $name = htmlspecialchars(trim(($_POST['name'])));
        $gender = $_POST['gender'];
        $email = htmlspecialchars(trim(($_POST['email'])));
        $phone = htmlspecialchars(trim(($_POST['phone'])));
        $avatar = htmlspecialchars(trim(($_POST['avatar'])));

        $game = htmlspecialchars(trim(($_POST['game'])));
        $numberOfCards = htmlspecialchars(trim(($_POST['numberOfCards'])));
        
        
        
        
        if (!$name) {
            //chyba
            array_push($invalidInputs, 'Není zadané jméno');
        }
        if (!$email) {
            //chyba
            array_push($invalidInputs, 'Není zadaný email');
        }
        elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($invalidInputs,'Email není validní');
        }
        if (!$avatar) {
            //chyba
            array_push($invalidInputs, 'Není zadaný avatar');
        }
        
        if (!$phone) {
            //chyba
            array_push($invalidInputs, 'Není zadaný mobil');
        }
        elseif (!preg_match('/^(\+420)?-? ?[1-9][0-9]{2}-? ?[0-9]{3}-? ?[0-9]{3}/',$phone)) {
           
            array_push($invalidInputs,'Mobil není validní');
        }
        if (!$game) {
            //chyba
            array_push($invalidInputs, 'Není zadaná hra');
        }
        if (!$numberOfCards) {
            //chyba
            array_push($invalidInputs, 'Není zadaný počet karet');
        }elseif(!preg_match('/[0-9]+/',$numberOfCards)){
            array_push($invalidInputs, 'Špatně zadaný počet karet');
        }elseif($numberOfCards<19 or $numberOfCards>81){
            array_push($invalidInputs, 'Špatně zadaný počet karet');
        }

    }

function echoErrors(){
    foreach($invalidInputs as $msg){
        echo $msg;
        echo ' ';
        echo '\r\n';
    }
}

?>
<?php require './includes/head.php'; ?>
<body>
<main class="container">
    <br>
    <h1 class="text-center">Form</h1>
    <div class="row justify-content-center">
    <ul >
        <?php foreach($invalidInputs as $msg):?>
                    <div class="error"><?php echo  $msg;?></div>
        <?php endforeach; ?>
    </ul>

        <form class="form-signup" method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label>Name*</label>
                <input class="form-control" name="name" value="<?php echo isset($name) ? $name : '' ?>">
                <small class="text-muted">Example: Homer Simpson</small>
            </div>
            <div class="form-group">
                <label>Gender*</label>
                <select class="form-control" name="gender" >
                    <option value="N" <?php echo $gender == 'N' ? ' selected' : '' ?>>Neutral</option>
                    <option value="F" <?php echo $gender == 'F' ? ' selected' : '' ?>>Female</option>
                    <option value="M" <?php echo $gender == 'M' ? ' selected' : '' ?>>Male</option>
               
                </select>
            </div>
            <div class="form-group">
                <label>Email*</label>
                <input class="form-control" name="email" value="<?php echo isset($email) ? $email : '' ?>">
                <small class="text-muted">Example: example@gmail.com</small>
            </div>
            <div class="form-group">
                <label>Phone*</label>
                <input class="form-control" name="phone" value="<?php echo isset($phone) ? $phone : '' ?>">
                <small class="text-muted">Example: +420 841 147 239</small>
            </div>
            <div class="form-group">
                <label>Avatar URL*</label>
                <input class="form-control" name="avatar" value="<?php echo isset($avatar) ? $avatar : '' ?>">
                <small class="text-muted">Example: https://eso.vse.cz/~lamj00/cv03/img/homer.jpg</small>
                <?php if(isset($avatar)){
                        echo '<img class="avatar"  src=',$avatar,' alt="avatar">';
                }
                ?>
                
            </div>
            <div class="form-group">
                <label>Game*</label>
                <input class="form-control" name="game" value="<?php echo isset($game) ? $game : '' ?>">
                <small class="text-muted">Example: Bingo!</small>
            </div>
            <div class="form-group">
                <label>Number of cards*</label>
                <input class="form-control" name="numberOfCards" value="<?php echo isset($numberOfCards) ? $numberOfCards : '' ?>">
                <small class="text-muted">Musí být číslo mezi 20 a 80</small>
            </div>
            <button class="btn btn-primary" type="submit">Submit</button>
        </form>
    </div>
</main>
</body>
<?php require './hotreloader.php'; ?>
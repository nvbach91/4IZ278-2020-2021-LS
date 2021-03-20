<?php
    
    $databaseFileName = __DIR__ . "/../database/users.db";
    $users = file($databaseFileName);
    $people=[];
    foreach($users as $user){
        $lide = explode(';', $user);
        $user = [
            'name' => $lide[0],
            'email' => $lide[1],
            'password' => $lide[2],
        ];
        array_push($people, $user);
    }
?>
<?php include __DIR__ . '/../incl/header.php' ?> 
    <main>
        <h1>All users</h1>
        <nav>
            <a href="../index.php">Home</a>
            <a href="../registration.php">Registration</a>
            <a href="../login.php">Login</a>
        </nav>
        <?php foreach($people as $person): ?>
            <div class="person">
                <h3><?php echo $person['name'] ?></h3>
                <p><?php echo $person['email'] ?></p>
            </div>
        <?php endforeach ?>
    </main>
<?php  include __DIR__ . "/../incl/footer.php" ?> 
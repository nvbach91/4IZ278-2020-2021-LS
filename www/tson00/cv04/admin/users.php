<?php require '../includes/header.php'//include pro veci bez php, require once vypisuje jen jednou?>
<h1>Homepage</h1>
    <a href="../index.php">Home</a><br>
    <a href="../registration.php">Go to registration</a></br>
    <a href="../login.php">Login</a></br>
    <a href="../admin/users.php">Users</a></br>
<?php
   echo '<h1>USERS</h1>';
   $databaseFileName = '../database/users.db';
   $lines = file($databaseFileName); //vsechno bude v pole
      foreach($lines as $line){
        if(!$line){
          continue;
        }
        //cely zaznam ktery zpracujeme
        $fields = explode(';',$line);//rozdelime udaje
        $user = ['name' =>$fields[0],
                'email' =>$fields[1],
                ];

             
                echo '<div class="row">';
                echo '<div class="col">';
                echo $user['name'];
                echo '</div><div class="col">';
                echo $user['email'];
                echo '</div></div>';
      }

?>
<?php require '../hotreload.php'; ?>
</body>
</html>
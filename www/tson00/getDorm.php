<?php 

include "database_connection.php";

$users_arr = array();


   $sql = "SELECT id,name FROM dormitory WHERE id_university=".$_POST['uni'];
   $statement = $pdo->prepare($sql);
   $statement->execute();

   $results = $statement->fetchAll();

   foreach($results as $result){
      $userid = $result['id'];
      $name = $result['name'];

      $users_arr[] = array("id" => $userid, "name" => $name);
   }



// encoding array to json format
echo json_encode($users_arr);
<?php

$password = hash('sha256',$_POST["password"]);
$name = $_POST["name"];
$sql2 = "INSERT INTO users (id_user, name, email, pass) VALUES (NULL,?,?,?)";
$stmt = $conn->prepare($sql2); 
$stmt->bind_param("sss", $name, $email, $password);
$stmt->execute();
$stmt->close();
$conn->close();
?>
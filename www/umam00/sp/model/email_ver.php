<?php

$email = $_POST["email"];  
include ('model/pdo.php');
$sql = "SELECT email FROM USERS WHERE email=?";
$stmt = $conn->prepare($sql); 
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_all(MYSQLI_ASSOC);

?>
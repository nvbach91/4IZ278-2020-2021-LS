<?php

include ('model/pdo.php');
$sql = "SELECT email FROM users WHERE email=?";
$stmt = $conn->prepare($sql); 
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_all(MYSQLI_ASSOC);
?>
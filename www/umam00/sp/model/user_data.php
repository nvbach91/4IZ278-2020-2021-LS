<?php
$id_user = $_SESSION["ID"];
$sql = "SELECT name, email from users where id_user = ?";
$stmt = $conn->prepare($sql); 
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_array(MYSQLI_ASSOC);
?>
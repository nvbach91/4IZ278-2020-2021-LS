<?php
include ('model/pdo.php');
$id = $_SESSION["ID"];
$sql = "SELECT projects.* from projects, user_to_project where projects.id_project = user_to_project.id_project and user_to_project.id_user = ? order by projects.date_of_creation desc";
$stmt = $conn->prepare($sql); 
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_all(MYSQLI_ASSOC);

?>
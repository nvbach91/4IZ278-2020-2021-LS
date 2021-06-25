<?php
include ('model/pdo.php');
$id = $_SESSION["ID"];
if(isset($_GET["btn_search"]) and $_GET["find"] != null)
{
        $find =  $_GET["find"];
        $sql = "SELECT id_note, name, content, date_of_creation FROM notes where user_id = ?  and project_id = 0  and name like ? order by date_of_creation desc";
        $stmt = $conn->prepare($sql); 
        $stmt->bind_param("is", $id, $find);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
}
else
{
    $sql = "SELECT id_note, name, content, date_of_creation FROM notes where user_id = ?  and project_id = 0 order by date_of_creation desc";
    $stmt = $conn->prepare($sql); 
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC);
}

?>
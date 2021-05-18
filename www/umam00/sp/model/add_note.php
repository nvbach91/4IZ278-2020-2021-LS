<?php
if(isset($_POST["btn_add_note"]) and $_POST["btn_add_note"] == "enter")
{   
    include ('pdo.php');
    $title = $_POST["title"];
    $text = $_POST["text"];
    $date = date('Y-m-d H:i:s');
    $id = $_SESSION["ID"];
    $sql = "INSERT INTO notes(id_note, name, content, date_of_creation, USER_ID) VALUES (NULL,?,?,?,?)";
    $stmt = $conn->prepare($sql); 
    $stmt->bind_param("ssss", $title, $text, $date, $id);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    header("Location: .");
    exit();
}
?>
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
    include('controller/reset_page.php');
}
elseif(isset($_POST["btn_add_project_note"]) and $_POST["btn_add_project_note"] == "enter")
{   

    echo $_POST["project_id"];
    include ('pdo.php');
    $project_id= $_POST["project_id"];
    $title = $_POST["title"];
    $text = $_POST["text"];
    $date = date('Y-m-d H:i:s');
    $id = $_SESSION["ID"];
    $sql = "INSERT INTO notes(id_note, name, content, date_of_creation, project_ID, user_id) VALUES (NULL,?,?,?,?,?)";
    $stmt = $conn->prepare($sql); 
    $stmt->bind_param("ssssi", $title, $text, $date, $project_id, $id);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    $exit_page="?projects=".$project_id;
    include('controller/reset_page.php');
}
?>
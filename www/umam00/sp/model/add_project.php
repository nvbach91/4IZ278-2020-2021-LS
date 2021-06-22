<?php
if(isset($_POST["btn_add_project"]) and $_POST["btn_add_project"] == "add_project")
{   
    include ('pdo.php');
    $name = $_POST["title"];
    $text = $_POST["text"];
    $date = date('Y-m-d H:i:s');
    $id = $_SESSION["ID"];
    if(isset($name ) and isset($text))
    {
        $sql = "INSERT INTO projects(id_project, name, date_of_creation, user_id, description) VALUES (null,?,?,?,?)";
        $stmt = $conn->prepare($sql); 
        $stmt->bind_param("ssis", $name, $date, $id, $text);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        $exit_page="?projects";
        include('controller/reset_page.php');
    }
}
?> 
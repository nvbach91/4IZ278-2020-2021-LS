<?php
if(isset($_POST["btn_update_note"]))
{   
    if($_POST["btn_update_note"] == "update")
    {
        include ('pdo.php');
        $title = $_POST["title"];
        $text = $_POST["text"];
        $date = date('Y-m-d H:i:s');
        $id = $_SESSION["ID"];
        $id_note =  $_SESSION["NOTE_ID"];
        $sql = "UPDATE notes SET name=?, content=?, date_of_creation=? where user_id=? and id_note =?";
        $stmt = $conn->prepare($sql); 
        $stmt->bind_param("sssii", $title, $text, $date, $id, $id_note);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        include ('controller/reset_page.php');
    }
    elseif ($_POST["btn_update_note"] == "delete")
    {
        include ('pdo.php');
        $id_note =  $_SESSION["NOTE_ID"];
        $sql = "delete from notes where id_note = ?";
        $stmt = $conn->prepare($sql); 
        $stmt->bind_param("i",$id_note);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        if(isset($_POST["next_page"]))
        {
            $exit_page = "?projects=".$_POST["next_page"];
        }
        include ('controller/reset_page.php');

    }
}
if(isset($_POST["btn_update_projnote"]))
{
    if($_POST["btn_update_projnote"] == "update")
    {
        include ('pdo.php');
        $title = $_POST["title"];
        $text = $_POST["text"];
        $date = date('Y-m-d H:i:s');
        $id_note =  $_SESSION["NOTE_ID"];
        $sql = "UPDATE notes SET name=?, content=?, date_of_creation=? where id_note =?";
        $stmt = $conn->prepare($sql); 
        $stmt->bind_param("sssi", $title, $text, $date, $id_note);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        $exit_page = "?projects=".$_SESSION["PROJ_ID"];   
        clearStamp($id_note);
        include ('controller/reset_page.php');
    }
}
?>
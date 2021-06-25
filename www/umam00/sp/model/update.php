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

if(isset($_POST["btn_update_user"]) and $_POST["btn_update_user"] == "update")
{
    $error = null;
    if (isset($_POST["password"]))
    {
        if(CheckPass($_SESSION["ID"],$_POST["password"]))
        {
            if (isset($_POST["name"]) and $_POST["name"] != GetName($_SESSION["ID"]))
            {
                include ('model/pdo.php');
                $id = $_SESSION["ID"];
                $name = $_POST["name"];
                $sql = "UPDATE users SET name = ? WHERE id_user = ?";
                $stmt = $conn->prepare($sql); 
                $stmt->bind_param("si", $name, $id);
                $stmt->execute();
                $stmt->close();
                $conn->close();
            }
            if ($_POST["new_pass"] != null)
            {
                if(isset($_POST["new_pass_check"]) and $_POST["new_pass_check"] == $_POST["new_pass"])
                {
                    include ('model/pdo.php');
                    $id = $_SESSION["ID"];
                    $password = hash('sha256',$_POST["new_pass"]);
                    $sql = "UPDATE users SET pass = ? WHERE id_user = ?";
                    $stmt = $conn->prepare($sql); 
                    $stmt->bind_param("si", $password, $id);
                    $stmt->execute();
                    $stmt->close();
                    $conn->close();
                }
                else
                {
                    $error = 2;
                }
            }
        }
        else
        {
            $error = 1;
        }
    }
    if (isset($error))
    {
        $error_msg = "&error=".$error;
    }
    else
    {
        $error_msg = "&success";
    }

    $exit_page = "?settings".$error_msg;  
    include ('controller/reset_page.php');
}


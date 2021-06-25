<?php
if(isset($_POST["btn_edit_project"]))
{   
    if($_POST["btn_edit_project"] == "edit_project")
    {

        if(MembersCheck($_POST["members"]))
        {
            $member = explode(',', str_replace(' ', '',$_POST["members"]));
            $current_mem = explode(", ",GetProjectMembers($proj_id));
            include ('pdo.php');
            $name = $_POST["title"];
            $desc = $_POST["text"];
            $date = date('Y-m-d H:i:s');
            $id = $_SESSION["ID"];
            $proj_id = $_SESSION["PROJ_ID"];
            $sql = "UPDATE projects SET name=?, description=? where user_id=? and id_project =?";
            $stmt = $conn->prepare($sql); 
            $stmt->bind_param("ssii", $title, $text, $id, $id_note);
            $stmt->execute();
            $stmt->close();

            ClearMembers($proj_id);
            for ($i = 0; $i < count($member); $i++)
            {
                if(!in_array($member[$i],$current_mem))
                {
                    $user_id = GetIdByEmail($member[$i]);
                    $sql2 = "INSERT INTO user_to_project(id, id_project, id_user) VALUES (null,?,?)";
                    $stmt2 = $conn->prepare($sql2); 
                    $stmt2->bind_param("ii",$proj_id, $user_id);
                    $stmt2->execute();
                    $stmt2->close();
                }
            }
            $conn->close();
            $exit_page="?projects=$proj_id";
            include ('controller/reset_page.php');
        }
        else
        {
            $proj_id = $_SESSION["PROJ_ID"];
            $exit_page="?edit=project&proj_id=$proj_id&error=1";
            include ('controller/reset_page.php');
        }
  
    }
    elseif ($_POST["btn_edit_project"] == "delete")
    {
        include ('pdo.php');
        $proj_id = $_SESSION["PROJ_ID"];
        $sql = "delete from projects where id_project = ?";
        $stmt = $conn->prepare($sql); 
        $stmt->bind_param("i",$proj_id);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        ClearMembers($proj_id);
        $exit_page="?projects";
        include ('controller/reset_page.php');
    }
}
?>
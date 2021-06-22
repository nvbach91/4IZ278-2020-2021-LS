<?php
function has_dupes($array) {
    return count($array) !== count(array_unique($array));
}
function GetProjectName($id)
{
    include ('model/pdo.php');
    $sql = "SELECT name FROM projects WHERE id_project=?";
    $stmt = $conn->prepare($sql); 
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC);

    if($data)
    {
        foreach($data as $row)
        {
            $project_title = $row['name'];
        }
    }
    else
    {
        $project_title = "Error 404, name not found";
    }

    return $project_title;
}
function CheckEmail($email)
{
    include ('model/pdo.php');
    $sql = "SELECT email FROM users WHERE email=?";
    $stmt = $conn->prepare($sql); 
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC);
    if($data)
    {
        return true;
    }
    else
    {
        return false;
    }

}
function GetProjectDesc($id)
{
    include ('model/pdo.php');
    $sql = "SELECT description FROM projects WHERE id_project=?";
    $stmt = $conn->prepare($sql); 
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC);

    if($data)
    {
        foreach($data as $row)
        {
            $project_desc = $row['description'];
        }
    }
    else
    {
        $project_desc = "";
    }

    return $project_desc;
}
function GetProjectMembers($id)
{
    include ('model/pdo.php');
    $sql = "SELECT users.email from users, user_to_project WHERE users.id_user = user_to_project.id_user and user_to_project.id_project = ?";
    $stmt = $conn->prepare($sql); 
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC);
    $project_members = null;

    if($data)
    {
        foreach($data as $row)
        {
            $project_members .= $row['email'].", ";
        }
    }
    else
    {
        $project_members = "";
    }

    return $project_members;
}
function DeleteNote($id)
{
    include ('model/pdo.php');
    $sql = "DELETE FROM notes WHERE id_note = ?";
    $stmt = $conn->prepare($sql); 
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

function GetIdByEmail($email)
{
    include ('model/pdo.php');
    $sql = "SELECT id_user from users where email = ?";
    $stmt = $conn->prepare($sql); 
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC);
    $id = null;
    if($data)
    {
        foreach($data as $row)
        {
            $id = $row['id_user'];
        }
    }

    return $id;
}

function MembersCheck($members)
{
    $members=$_POST["members"];
    $error = null;
    if(str_contains($members, ","))
    {
        $members_ex = explode(',', str_replace(' ', '',$members));
        if(has_dupes($members_ex))
        {
            $error = true;
        }
        else
        {
            for ($i = 0; $i < count($members_ex); $i++)
            {
                if($members_ex[$i] != null)
                {
                    if (filter_var($members_ex[$i], FILTER_VALIDATE_EMAIL))
                    {
                        if(CheckEmail($members_ex[$i]))
                        {
                        }
                        else
                        {
                            $error = true;
                        }
                    }
                    else
                    {
                        $error = true;
                    }
                }

            }
        }
    }
    else
    {
        if($members != null)
        {
            if (filter_var($members, FILTER_VALIDATE_EMAIL))
            {
                if(CheckEmail($members))
                {
                }
                else
                {
                    $error = true;
                }
            }
            else
            {
                $error = true;
            }
        }
    }
    if($error == false)
    {
        return true;
    }
    else
    {
        return false;
    }
}

function ClearMembers($id_project)
{
    include ('model/pdo.php');
    $sql = "DELETE FROM user_to_project WHERE id_project = ?;";
    $stmt = $conn->prepare($sql); 
    $stmt->bind_param("i", $id_project);
    $stmt->execute();
}

function CheckOwner($id_user, $id_project)
{
    include ('model/pdo.php');
    $sql = "select id_project from projects where user_id = ? and id_project = ?";
    $stmt = $conn->prepare($sql); 
    $stmt->bind_param("ii", $id_user,$id_project);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC);
    if($data)
    {
       return true;
    }
    else
    {
        return false;
    }
}
function editStamp($note_id, $user_id, $date)
{
    include ('model/pdo.php');
    $sql = "UPDATE notes SET last_user_id = ?, last_edit = ? WHERE id_note = ?";
    $stmt = $conn->prepare($sql); 
    $stmt->bind_param("isi",$user_id,$date, $note_id);
    $stmt->execute();
}
function clearStamp($note_id)
{
    include ('model/pdo.php');
    $sql = "UPDATE notes SET last_user_id = null, last_edit = null WHERE id_note = ?";
    $stmt = $conn->prepare($sql); 
    $stmt->bind_param("i",$note_id);
    $stmt->execute(); 
}
function CheckAcces($note_id, $user_id)
{
    $check = null;
    $current_dateTime = new DateTime();

    include ('model/pdo.php');
    $sql = "select last_edit, last_user_id from notes where id_note = ?";
    $stmt = $conn->prepare($sql); 
    $stmt->bind_param("i", $note_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_array(MYSQLI_ASSOC);
    if($data)
    {
       if($data['last_user_id'] == $user_id or $data['last_user_id'] == null)
       {
        $check = true;
       }
       else
       {
            $last_dateTime = new DateTime($data['last_edit']);
            $interval = $current_dateTime->diff($last_dateTime);
           if($interval->m >= 30)
           {
            $check = true;
           }
           else
           {
            $check =  false;
           }
       }
    }
    else
    {
        $check =  true;
    } 

    if ($check == false)
    {
        return false;
    }
    else
    {
        editStamp($note_id, $user_id, $current_dateTime->format('Y-m-d H:i:s'));
        return true;
    }
}
?>
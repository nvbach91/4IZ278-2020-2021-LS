<?php
require "incl/header.php";
require "incl/navbar.php";
require_once "db/UsersDB.php";
require_once "db/Order.php";
require "functions/adminRequired.php";
$usersDB = new usersDB();
$users = $usersDB ->fetchAll();
?>
<h1 class="text-center">Users</h1>
<div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">username</th>
                <th scope="col">first name</th>
                <th scope="col">last name</th>
                <th scope="col">address</th>
                <th scope="col">email</th>
                <th scope="col"></th>
            </tr>
        </thead>
    <tbody>
        <?php foreach ($users as $user):?>
            <tr>
                <td><?php echo $user["ID"] ?></td>
                <td><?php echo $user["username"] ?></td>
                <td><?php echo $user["firstName"] ?></td>
                <td><?php echo $user["lastName"] ?></td>
                <td><?php echo $user["address"] ?></td>
                <td><?php echo $user["email"] ?></td>
                <td>
                    <button class="btn btn-outline-primary" >
                        <a href="editProfile.php?user_id=<?php echo $user["ID"]?>">Edit</a>
                    </button>
                </td>
            </tr>
        <?php endforeach;?>
    </tbody>
    </table>
</div>
<?php
require "incl/footer.php";
?>



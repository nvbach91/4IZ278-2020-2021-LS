<?php
require "incl/header.php";
require "incl/navbar.php";
require_once "db/Profile.php";

if(isset($_GET["user_id"])){
    $profile =new Profile($_GET["user_id"]);
    if(@$_GET["user_id"]!=$_SESSION["user_id"]){
        require "functions/adminRequired.php";
    }
}else{
    $profile = new Profile($_SESSION["user_id"]);
}


?>
<main class="cont" >
    <h1 class="text-center">Profile</h1>
    Hi <?php echo $profile -> getFirstName() ?>, this is your profile.</br>
    Username: <?php echo $profile -> getUsername() ?> </br>
    Full name: <?php echo $profile -> getFirstName()." ".$profile->getLastName() ?> </br>
    Address: <?php echo $profile -> getAddress() ?>

    <h3>Orders:</h3>
    <div>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Order ID</th>
                <th scope="col">Date</th>
                <th scope="col">Address</th>
                <th scope="col">Total price</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($profile ->getOrders() as $item):?>
                <tr>
                    <td><?php echo $item -> getId()?></td>
                    <td><?php echo $item -> getDate()?></td>
                    <td><?php echo $item -> getAddress()?></td>
                    <td><?php echo number_format($item -> getTotal(), 2), ' ', "$"; ?></td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>
    <button class="btn btn-primary"
            style="display: block;
            margin-left: auto;
            margin-right: auto"
            type="button" >
        <a href="editProfile.php?user_id=<?php echo $profile -> getId()?>">Edit profile</a>
    </button>
</main>

<?php
require "incl/footer.php";
?>



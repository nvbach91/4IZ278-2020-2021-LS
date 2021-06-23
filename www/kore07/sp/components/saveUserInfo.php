<?php require_once __DIR__ . '/../database/UsersDB.php'; ?>
<?php
    if(!isset($_SESSION)){
        session_start();
    }

    $usersDB = new UsersDB();
    
    $submittedForm = !empty($_POST);
    
    if ($submittedForm) {
        $name = trim(@$_POST['name']);
        $email = trim(@$_POST['email']);
        $address = trim(@$_POST['address']);
        $zip = trim(@$_POST['zip']);
        $city = trim(@$_POST['city']);
        $country = trim(@$_POST['country']);
        $phone = trim(@$_POST['phone']);

        $sets = array(
            'user_name' => $name,
            'user_email' => $email,
            'user_address' => $address,
            'user_zip' => $zip,
            'user_city' => $city,
            'user_country' => $country,
            'user_phone' => $phone,
        );

        $wheres = array(
            'user_id' => $_SESSION['user_id'],
        );

        $usersDB->updateBy($wheres, $sets);

        // header('Location: ../profile.php');
    };
?>
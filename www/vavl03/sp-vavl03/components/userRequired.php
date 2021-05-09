<?php
if(session_status() != 2){
    session_start();
}
if (time() > $_SESSION['access_token_expiries']) { 
    unset($_SESSION['access_token_expiries']);
 }
// if user is not logged in, redirect to home page
if (!isset($_SESSION['fb_access_token']) || !isset($_SESSION['access_token_expiries']) ){
    header('Location: /4IZ270-2020-2021-LS/www/vavl03/sp-vavl03/signin.php');
    exit();
}





/*session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: signin.php');
    exit();
}

// v session je user id uzivatele, ted ho nacteme z db
$stmt = $db->prepare('SELECT * FROM users WHERE id = :id LIMIT 1'); //limit 1 jen jako vykonnostni optimalizace, 2 stejne maily se v db nepotkaji
$stmt->execute([
    'id' => $_SESSION['user_id']
]);

// nacte do promenne $user aktualne prihlaseneho usera, bude pristupny z cele aplikace
$current_user = $stmt->fetchAll()[0]; //vezmi prvni zaznam z db

// pokud by v db z nejakeho duvodu user nebyl (treba byl mezitim nejak smazan), tak vymaz session a jdi na prihlaseni
if (!$current_user) {
    session_destroy();
    header('Location: index.php');
    exit();
}else{
    header('Location: order-methods.php');
}*/
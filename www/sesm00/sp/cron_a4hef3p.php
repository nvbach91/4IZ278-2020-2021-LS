<?php
//  Toto je cron script který se spouští každý den v 04:38 a posílá maily o konci platnosti známky

require_once __DIR__ . '/includes/utils/baseHelper.php';
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/vendor/autoload.php';

function custom_autoloader($className) {
    if(file_exists(__DIR__ . "/controllers/" . $className . ".php")){
        require __DIR__ . "/controllers/" . $className . '.php';
        return true;
    }elseif(file_exists(__DIR__ . "/includes/classes/" . $className . ".php")) {
        require __DIR__ . "/includes/classes/" . $className . '.php';
        return true;
    }elseif(file_exists(__DIR__ . "/includes/interfaces/" . $className . ".php")) {
        require __DIR__ . "/includes/interfaces/" . $className . '.php';
        return true;
    }
    return false;
}

spl_autoload_register("custom_autoloader");

$datetime = new DateTime(null, new DateTimeZone(TIME_ZONE));
$datetime->modify('+4 day');
$date = $datetime->format("Y-m-d") . " 00:00:00";
$rows = Database::getInstance()->selectQ(
    "SELECT " . ORDER_PRODUCT_FIELDS_TABLE . ".id AS field_id, " . USERS_TABLE . ".id AS user_id FROM " . ORDER_PRODUCT_FIELDS_TABLE . " " .
    "LEFT JOIN " . ORDER_PRODUCT_TABLE . " ON order_products_id = " . ORDER_PRODUCT_TABLE . ".id " .
    "LEFT JOIN " . ORDER_TABLE . " ON orders_id = " . ORDER_TABLE . ".id " .
    "LEFT JOIN " . USERS_TABLE . " ON users_id = " . USERS_TABLE . ".id " .
    "WHERE registration_plate < :date",
    array('date' => $date));

foreach ($rows as $row) {
    $field = ProductField::getInstance($row['field_id']);
    $field->load();
    $user = User::getInstance($row['user_id']);
    $user->load();

    try {
        mail($user->email, "Konec platnosti dálniční známky", "Dobrý den,\nu vozidla " . $field->registration_plate . " se přiblížil konec platnosti dálniční známky.\n" .
            "Platnost do: " . date("j.n.Y", strtotime($field->valid)) . "\n " .
            "platnost si můžete prodloužit <a href=\"" . "//" . $_SERVER['HTTP_HOST'] . getBaseUrl() . "\">zde</a>");
    } catch (Exception $e) {

    }

}


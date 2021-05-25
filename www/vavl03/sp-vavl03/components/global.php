<?php 
const GLOBAL_CURRENCY = '$';

function getInputValidClass($key, $errors) {
    return array_key_exists($key, $errors) ? ' is-invalid' : '';
};

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

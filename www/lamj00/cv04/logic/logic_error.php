<?php
function echoErrors(){
    foreach ($invalidInputs as $msg) {
        echo $msg;
        echo ' ';
        echo '\r\n';
    }
}
?>
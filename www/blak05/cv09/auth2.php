<?php

$number = @$_COOKIE['privilege'];
//echo $number;
if($number != 2){
    $pageOffset = @$_COOKIE['offset'];
    header("Location: index.php?offset=$pageOffset");
}
?>
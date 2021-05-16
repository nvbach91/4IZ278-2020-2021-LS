<?php
require "db/categoriesDB.php";

$catDB = new categoriesDB();
$categories = $catDB->fetchAll();


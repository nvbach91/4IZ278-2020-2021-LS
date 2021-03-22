<?php

require_once 'Database.php';

class UsersDB extends Database
{

    public function save()
    {
        echo 'A user was saved  ', PHP_EOL;
    }

}

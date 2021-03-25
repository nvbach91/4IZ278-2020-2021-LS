<?php

class UsersDB extends Database
{
    function __construct()
    {
        parent::__construct('users');
    }

    public function create($item)
    {
        parent::create($item);
        echo 'A new user was created.', PHP_EOL;
    }

    public function fetch()
    {
        $users = parent::fetch();
        echo 'The users were fetched.', PHP_EOL;
        print_r($users);
        return $users;
    }

    public function save($id, $item)
    {
        parent::save($id, $item);
        echo 'A user was updated.', PHP_EOL;
    }

    public function delete($id)  
    { 
        parent::delete($id);
        echo 'A user was deleted.', PHP_EOL; 
    }
}

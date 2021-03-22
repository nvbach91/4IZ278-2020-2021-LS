<?php


class UsersDB extends Database
{
    protected $file = "Users";

    public function fetch($args)
    {
        $users = $this->readDatabase();
        foreach ($users as $user)
        {
            if($user[0]==$args['id']){
                echo "User ", $args['id'], " was fetched", PHP_EOL;
                echo "ID: ", $user[0], " Name: ", $user[1], " Age: ", $user[2], PHP_EOL;
                return;
            }
        }
        echo "User does not exist", PHP_EOL;
    }

    public function create($args)
    {
        $users = $this->readDatabase();
        foreach ($users as $user) {
            if ($user[0] == $args['id']) {
                echo "User with this ID is already created!";
                return;
            }
        }
        array_push($users, array($args['id'], $args['name'], $args['age']));
        $this->writeDatabase($users);
        echo "User with id ", $args['id'], ", name ", $args['name'], " and age ", $args['age'], " was created", PHP_EOL;
    }

    public function update($args)
    {
        $users = $this->readDatabase();
        $i = 0;
        foreach ($users as $user) {
            if ($user[0]==$args['id']){
                unset($users[$i]);
                array_push($users, $args);   
                $this->writeDatabase($users);
                echo "User ", $args['id'], " was updated", PHP_EOL;
                return;
            }
            $i++;
        }
        echo "User does not exist", PHP_EOL;
    }

    public function delete($args)
    {
        $users = $this->readDatabase();
        $i = 0;
        foreach ($users as $user) {
            if ($user[0]==$args['id']){
                unset($users[$i]);   
                $this->writeDatabase($users);
                echo "Order ", $args['id'], " was deleted", PHP_EOL;
                return;
            }
            $i++;
        }
        echo "User does not exist", PHP_EOL;
    }
}
?>
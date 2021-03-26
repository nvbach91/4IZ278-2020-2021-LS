<?php


class UsersDB extends Database
{
    protected $file = "users";

    public function fetch($args){
        $user = $this->readDatabase()[$args['id']];
        if (isset($user)) {
            echo "User ", $args['id'], " was fetched", PHP_EOL;
            echo "Name: ", $user[0], " Email: ", $user[1], " Age: ", $user[2], PHP_EOL;
        } else {
            echo "User does not exist", PHP_EOL;
        }
    }

    public function create($args)
    {
        $users = $this->readDatabase();
        array_push($users, array($args['name'], $args['email'], $args['age']));
        $this->writeDatabase($users);
        echo "User with name ", $args['name'], ", email ", $args['email'], ", and age ", $args['age'], " was created", PHP_EOL;
    }

    public function update($args)
    {
        $users = $this->readDatabase();
        if (isset($users[$args['id']])) {
            $users[$args['id']] = array_values($args['user']);
            $this->writeDatabase($users);
            echo "User ", $args['id'], " was updated", PHP_EOL;
        } else {
            echo "User does not exist", PHP_EOL;
        }
    }

    public function delete($args)
    {
        $users = $this->readDatabase();
        if (isset($users[$args['id']])) {
            unset($users[$args['id']]);
            $this->writeDatabase($users);
            echo "User with id ", $args['id'], " was deleted", PHP_EOL;
        } else {
            echo "User does not exist", PHP_EOL;
        }
    }
} 
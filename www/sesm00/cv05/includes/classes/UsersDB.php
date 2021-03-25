<?php


class UsersDB extends Database
{
    protected $file = "users";
    //['name' => 'Dave', 'permission' => 'Read', 'phone' => '123456789']

    public function fetch($args)
    {
        $user = $this->readDatabase()[$args['id']];
        if (isset($user)) {
            echo "User ", $args['id'], " was fetched", PHP_EOL;
            echo "Name: ", $user[0], " Permission: ", $user[1], " Phone: ", $user[2], PHP_EOL;
        } else {
            echo "User does not exist", PHP_EOL;
        }
    }

    public function create($args)
    {
        $users = $this->readDatabase();
        array_push($users, array($args['name'], $args['permission'], $args['phone']));
        $this->writeDatabase($users);
        echo "User with name ", $args['name'], ", permission ", $args['permission'], ", and phone ", $args['phone'], " was created", PHP_EOL;
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
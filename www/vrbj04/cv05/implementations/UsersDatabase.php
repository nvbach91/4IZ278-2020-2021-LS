<?php

namespace cv05\implementations;

use cv05\Database;
use cv05\DatabaseConfiguration;

final class UsersDatabase extends Database
{
    public function __construct() {
        parent::__construct(new DatabaseConfiguration(
            "/database/users",
            ".db",
            ";"
        ));
    }

    public function create(array $parameters) {
        $users = $this->loadDatabaseItems();
        $users[] = $parameters;

        $this->storeDatabaseItems($users);
    }

    public function fetch(int $id) {
        $users = $this->loadDatabaseItems();
        $matching = array_filter($users, function ($item) use ($id) { return $item[0] == $id; });

        if (count($matching) === 0) {
            return null;
        }

        return array_values($matching)[0];
    }

    public function save(int $id, array $parameters) {
        $users = $this->loadDatabaseItems();

        foreach ($users as $index => $user) {
            if ($user[0] == $id) {
                $users[$index] = $parameters;
            }
        }

        $this->storeDatabaseItems($users);
    }

    public function delete(int $id) {
        $users = $this->loadDatabaseItems();
        $others = array_filter($users, function ($item) use ($id) { return $item[0] != $id; });

        $this->storeDatabaseItems(array_values($others));
    }
}
<?php

namespace cv05\implementations;

use cv05\Database;
use cv05\DatabaseConfiguration;

final class UsersDatabase extends Database
{
    public function __construct() {
        parent::__construct(new DatabaseConfiguration(
            "/app/database/users",
            ".db",
            ";"
        ));
    }

    public function create(array $parameters) {
        $serialized = json_encode($parameters);
        $this->log("Created user with parameters: [$serialized].");
    }

    public function fetch() {
        $this->log("Fetched the user from database.");
    }

    public function save() {
        $this->log("Saved the user to database.");
    }

    public function delete() {
        $this->log("Deleted the user from database.");
    }
} 
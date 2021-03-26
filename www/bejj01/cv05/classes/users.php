<?php

require_once  __DIR__ . '/database.php';

class UsersDB extends AbstractDatabase {

    public function __construct($keys, $idIndex) {
        parent::__construct('/users', $keys, $idIndex);
    }

    public function create($args) {
        $keys = array_keys($args);
        if ( count($args) !== count($this->columns) && !empty(array_diff($keys, $this->columns)) ) {
            echo 'User cannot be created. Wrong parameters entered.', nl2br("\n");
            return;
        }

        $users = $this->getAllData($this->idIndex, $this->columns);

        if (key_exists($args[$this->columns[$this->idIndex]], $users)) {
            $this->outputAlreadyExistingIdMessage('User', $args);
            return;
        }

        $this->createRecord($args);

        echo 'New user was created with parameters: ', $this->outputUserData($args), nl2br("\n");
    }

    public function fetch($email) {
        $user = $this->getRecord($email, $this->idIndex, $this->columns);
        if ($user) {
            echo 'A user ', $user['name'] ,' was fetched. User\'s data: ', $this->outputUserData($user), nl2br("\n");
        }
        else {
            $this->outputNotFoundIdMessage('Fetch', 'User', $email);
        }
        
    }

    public function update($email, $updatedValues) {
        $user = $this->getRecord($email);

        if ($user) {
            $updatedUser = $this->getUpdatedRecord($user, $updatedValues);
            if (!$updatedUser) {
                echo 'You are trying to update non-existent user columns data.', nl2br("\n");
            }
            else {
                echo 'User data for user ', $user['name'], ' was updated. New data: ', $this->outputUserData($updatedUser), nl2br("\n");
            }
        }
        else {
            $this->outputNotFoundIdMessage('Update', 'User', $email);
        }
    }

    public function delete($email) {
        if ($this->removeRecord($email)) {
            echo 'A user with email: ', $email, ' was deleted', nl2br("\n");
        }
        else {
            $this->outputNotFoundIdMessage('Delete', 'User', $email);
        }
    }

    private function outputUserData($user) {
        // excluded outputing confidential password info
        return '[ Name: ' .  $user['name'] . ', Email: ' . $user['email'] . ', Age: ' .  $user['age'] . ' ]';
    }
}

$users = new UsersDB(['name', 'email', 'password', 'age'], 1);
// clear data files before, only for testing purpose
$users->clear();
$users->create(['name' => 'Karel', 'email' => 'karel@nevim.cz', 'password' => '12345678', 'age' => 26]);
// could not create user with same email address
$users->create(['name' => 'Karel', 'email' => 'karel@nevim.cz', 'password' => '12345678', 'age' => 26]);
$users->create(['name' => 'Adam', 'email' => 'adam@nevim.cz', 'password' => '123abcdef', 'age' => 30]);
$users->create(['name' => 'David', 'email' => 'david@nevim.cz', 'password' => '123abcdef', 'age' => 25]);
// will fetch user
$users->fetch('karel@nevim.cz');
// cannot delete non existent user
$users->delete('notexistingmail@mail.cz');
$users->delete('karel@nevim.cz');
// user was deleted -> fetch should fail
$users->fetch('karel@nevim.cz');
$users->update('david@nevim.cz', ['name' => 'Tomas', 'password' => '125689', 'age' => 21]);
// wrong column id -> fail
$users->update('david@nevim.cz', ['coconut' => 'yes']);

?>
<?php

class UsersDB extends Database {
    public function create($args) { 
        $input =
        [
            'id' => $args['id'],
            'name' => $args['name'],
            'age' => $args['age']
        ];

        $file = file($this->dbPath.'users'.$this->dbExtension);
        $isExistingUser = false;


            foreach ($file as $record) {
                if (!$record) {
                    continue;
                }
                $fields = explode(';', $record);
                $user =
                    [
                        'id' => $fields[0]
                    ];

                if ($user['id'] === $input['id']) {
                    $isExistingUser = true;
                    break;
                }
            }

            if ($isExistingUser) {
                echo "<br>User with this id already exists";
            } else {$record = implode($this->delimiter, $input) . "\r\n";
                file_put_contents($this->dbPath.'users'.$this->dbExtension, $record, FILE_APPEND);

                echo '<br>User ', $args['name'], ' age: ', $args['age'], ' was created', PHP_EOL; }


    }
    public function fetch($args)  { 

        $userId = $args['id'];

        $output =
        [
            $name = '',
            $age = ''
        ];

        $file = file($this->dbPath.'users'.$this->dbExtension);
        $isExistingUser = false;


            foreach ($file as $record) {
                if (!$record) {
                    continue;
                }
                $fields = explode(';', $record);
                $user =
                    [
                        'id' => $fields[0],
                        'name' => $fields[1],
                        'age' => $fields[2],
                    ];

                if ($user['id'] === $userId) {
                    $isExistingUser = true;
                    $output['name'] = $user['name'];
                    $output['age'] = $user['age'];
                    break;
                }
            }

            if ($isExistingUser) {
                echo "<br>" . $output['name']. ' '. $output['age'];
                echo "<br>". 'A user was fetched', PHP_EOL;
            } else {echo "<br>" . 'User not found';
                echo "<br>". 'User was not fetched', PHP_EOL;}

     }

    public function save($args)   
    { 
        $userId = $args['id'];
        $newName = $args['name'];
        $newAge = $args['age'];

        $output =
        [
            $name = '',
            $age = ''
        ];

        $file = file($this->dbPath.'users'.$this->dbExtension);
        $isExistingUser = false;


            foreach ($file as $record) {
                if (!$record) {
                    continue;
                }
                $fields = explode(';', $record);
                $user =
                    [
                        'id' => $fields[0],
                        'name' => $fields[1],
                        'age' => $fields[2],
                    ];

                if ($user['id'] === $userId) {
                    $user['name'] = $newName;
                    $user['age'] = $newAge;
                    $output['name'] = $user['name'];
                    $output['age'] = $user['age'];
                    $isExistingUser = true;
                    break;
                }
            }

            if ($isExistingUser) {
                $this -> delete(['id' => $userId]);
                $this -> create(['id' => $userId, 'name' => $output['name'], 'age' => $output['age']]);
                echo "<br>" . $output['name']. ' '. $output['age'];
                echo "<br>". 'A user was updated', PHP_EOL;
            } else {echo "<br>" . 'User not found';
                echo "<br>". 'User was not updated', PHP_EOL;}

    }
    public function delete($args) 
    {
        $userId = $args['id'];
        $output =
        [
            $name = '',
            $age = ''
        ];

        $file = file($this->dbPath.'users'.$this->dbExtension);
        $isExistingUser = false;


            foreach ($file as $record) {
                if (!$record) {
                    continue;
                }
                $fields = explode(';', $record);
                $user =
                    [
                        'id' => $fields[0],
                        'name' => $fields[1],
                        'age' => $fields[2],
                    ];

                if ($user['id'] === $userId) {
                    $output['name'] = $user['name'];
                    $output['age'] = $user['age'];
                    $isExistingUser = true;
                    $replace = str_replace($record,'',$file);
                    file_put_contents($this->dbPath.'users'.$this->dbExtension,$replace);
                    break;
                }
            }

            if ($isExistingUser) {
                echo "<br>" . $output['name']. ' '. $output['age'];
                echo '<br> A user was deleted', PHP_EOL;
            } else {echo "<br>" . 'User not found';
                echo '<br> User was not deleted', PHP_EOL; }


    }
}

?>
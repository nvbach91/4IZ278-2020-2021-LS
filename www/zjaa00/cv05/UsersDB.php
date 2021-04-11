<?php
class UsersDB extends Database {

  public function create($args) {
    $users = $this->fetchDB();
    $user['name'] = $args['name'];
    $user['age'] = $args['age'];
    array_push($users, $user);
    $this->rewriteDB($users);
    
    echo 'User ', $args['name'], ' (' . (sizeof($users) - 1) . ')', ' age: ', $args['age'], ' was created', PHP_EOL; 
  }
  
  public function fetch($id) {
    $users = $this->fetchDB();
    if (isset($users[$id])) {
      echo 'User ', $id,' was fetched', PHP_EOL;
      echo 'Name ', $users[$id][0], ' Age: ', $users[$id][1], PHP_EOL;
    } else {
      echo "Non-existing user", PHP_EOL;
    }
  }

  public function save($id, $args) {
    $users = $this->fetchDB();
    if (isset($users[$id])) {
      $users[$id] = $args;
      $this->rewriteDB($users);  

      echo 'User ', $id,' was saved', PHP_EOL;
      echo 'Name ', $users[$id]['name'], ' Age: ', $users[$id]['age'], PHP_EOL;
    } else {
      echo "Non-existing user", PHP_EOL;
    }
  }
  
  public function delete($id) {
    $users = $this->fetchDB();
    if (isset($users[$id])) {
      $name = $users[$id][0];
      $age = $users[$id][1];
      unset($users[$id]);
      $users = array_values($users);
      $this->rewriteDB($users);
      echo 'User ', $id,' was deleted', PHP_EOL;
      echo 'Name ', $name, ' Age: ', $age, PHP_EOL;
    } else {
      echo "Non-existing user", PHP_EOL;
    }
  }

}

$users = new UsersDB();
$users->clearData(); //resetuje databázu
$users->create(['name' => 'Dave', 'age' => 42]);
$users->create(['name' => 'Adam', 'age' => 21]);
$users->fetch(1);
$users->save(0, ['name' => 'Jerry', 'age' => 63]);
$users->delete(1);
echo PHP_EOL;